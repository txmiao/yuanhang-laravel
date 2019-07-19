<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MessageRequest;
use App\Jobs\SendMessageForAll;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * 消息列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::pluck('name', 'id');
        $params = [
            '_t' => $request->input('_t', 'title'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Message::with('user')->select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.message.index', compact('lists', 'users', 'params'));
    }

    /**
     * 新增消息
     * @param MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageRequest $request)
    {
        switch ($request->send_type) {
            case 'all':
                $attribute = $request->only(['type', 'title', 'content']);
                dispatch((new SendMessageForAll($attribute))->onQueue('HusoSendMessage'));

                //极光推送消息
                $client = new \JPush\Client(config('jiguang.app_key'), config('jiguang.master_secret'));
                $client->push()
                    ->setOptions(null, null, null, true)
                    ->setPlatform('all')
                    ->addAllAudience()
                    ->iosNotification($request->get('content'), [
                        'title' => $request->get('title'),
                        'sound' => 'default',
                    ])
                    ->androidNotification($request->get('content'), [
                            'title' => $request->get('title'),
                        ]
                    )->send();

                return self::success('新增消息成功');
                break;

            case 'single':
                try {
                    $user = User::findOrFail($request->user_id);
                    $message = new Message($request->all());
                    if ($message->save()) {
                        //新增用户未读消息数
                        $user->increment('notification_count');

                        //极光推送消息
                        $client = new \JPush\Client(config('jiguang.app_key'), config('jiguang.master_secret'));
                        $client->push()
                            ->setOptions(null, null, null, true)
                            ->setPlatform('all')
                            ->addAlias('hs' . $user->phone)
                            ->iosNotification($request->get('content'), [
                                'title' => $request->get('title'),
                                'sound' => 'default',
                            ])
                            ->androidNotification($request->get('content'), [
                                    'title' => $request->get('title'),
                                ]
                            )->send();

                        return self::success('新增消息成功');
                    }
                } catch (\Exception $exception) {
                    return self::error('操作失败，请重试');
                }
                break;

            case 'exclusive':
                //极光推送消息
                $client = new \JPush\Client(config('jiguang.app_key'), config('jiguang.master_secret'));
                $client->push()
                    ->setOptions(null, null, null, true)
                    ->setPlatform('all')
                    ->addTag('exclusive')
                    ->iosNotification($request->get('content'), [
                        'title' => $request->get('title'),
                        'sound' => 'default',
                    ])
                    ->androidNotification($request->get('content'), [
                            'title' => $request->get('title'),
                        ]
                    )->send();

                foreach (User::where('type', User::TYPE_EXCLUSIVE)->cursor() as $user) {
                    $message = new Message($request->all());
                    $message->user_id = $user->id;
                    if ($message->save()) {
                        $user->increment('notification_count');
                    }
                }
                return self::success('新增消息成功');
                break;

            case 'common':
                //极光推送消息
                $client = new \JPush\Client(config('jiguang.app_key'), config('jiguang.master_secret'));
                $client->push()
                    ->setOptions(null, null, null, true)
                    ->setPlatform('all')
                    ->addTag('common')
                    ->iosNotification($request->get('content'), [
                        'title' => $request->get('title'),
                        'sound' => 'default',
                    ])
                    ->androidNotification($request->get('content'), [
                            'title' => $request->get('title'),
                        ]
                    )->send();

                foreach (User::where('type', User::TYPE_COMMENT)->cursor() as $user) {
                    $message = new Message($request->all());
                    $message->user_id = $user->id;
                    if ($message->save()) {
                        $user->increment('notification_count');
                    }
                }
                return self::success('新增消息成功');
                break;
        }
    }

    /**
     * 群发系统消息
     * @param $attribute
     */
    public static function sendAll($attribute)
    {
        User::chunk(100, function ($users) use ($attribute) {
            if (!$users) return false;
            foreach ($users as &$user) {
                $message = new Message($attribute);
                $message->user_id = $user->id;
                if ($message->save()) {
                    //新增用户未读消息数
                    User::find($user->id)->increment('notification_count');
                }
            }
            unset($user);
        });
    }

    public function show($id)
    {
        //
    }

    /**
     * 删除消息
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->delete()) {
            return self::success('删除成功');
        }
        return self::error('删除失败');
    }
}
