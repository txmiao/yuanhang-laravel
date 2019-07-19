<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\CollectionRequest;
use App\Models\Collection;
use App\Models\Company;
use App\Models\System;
use App\Models\User;
use App\Transformers\CollectionTransformer;
use App\Transformers\UserTransformer;

class CollectionController extends Controller
{
    /**
     * 收藏列表
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $lists = Collection::where('user_id', $this->user()->id)->paginate(10);
        return $this->response->paginator($lists, new CollectionTransformer());
    }

    /**
     * 添加收藏
     * @param CollectionRequest $request
     * @param Collection $collection
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(CollectionRequest $request, Collection $collection)
    {
        $user = $this->user();
        $config = System::pluck('value', 'code');
        if (count($user->company) && ($user->company->id == $request->company_id)) {
            return $this->response->errorForbidden('不能收藏自己的公司哦');
        }

        //当前用户是否已收藏
        $beCollected = $collection->where([
            ['user_id', $user->id],
            ['company_id', $request->company_id]
        ])->count();
        if ($beCollected) return $this->response->errorForbidden('您已经收藏过此公司了');

        $company = Company::findOrFail($request->company_id);
        $company->company_ext->increment('collection_times'); //增加公司收藏量
        $collection->fill($request->all());
        $collection->company_logo = $company->logo;
        $collection->company_name = $company->full_name;
        $collection->company_address = $company->full_address;
        $collection->user_id = $user->id;
        $collection->save();


        //极光推送给被收藏的公司消息
        $client = new \JPush\Client(config('jiguang.app_key'), config('jiguang.master_secret'));
        $client->push()
            ->setOptions(null, null, null, true)
            ->setPlatform('all')
            ->addAlias('hs' . $company->user->phone)
            ->setNotificationAlert('你被' . $user->name . '收藏了')
            ->send();

        //如果收藏量超过系统设定值给用户推送消息给用户
        if ($config['collection_number'] == $company->company_ext->collection_times) {
            $client->push()
                ->setOptions(null, null, null, true)
                ->setPlatform('all')
                ->addAlias('hs' . $company->user->phone)
                ->setNotificationAlert('您的公司收藏量已经超过' . $config['collection_number'] . '，快去看看吧~')
                ->send();
        }

        return $this->response->item($collection, new CollectionTransformer());
    }

    /**
     * 取消收藏
     * @param $id
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        $collection->company->company_ext->decrement('collection_times'); //减少公司收藏量
        $collection->delete();
        return $this->response->noContent();
    }

    /**
     * 获取被收藏列表
     * @param User $user
     * @return \Dingo\Api\Http\Response
     */
    public function beCollections(User $user)
    {
        $userIds = Collection::where('company_id', $this->user()->company->id)
            ->pluck('user_id');
        $lists = $user->whereIn('id', $userIds)->paginate(10);

        return $this->response->paginator($lists, new UserTransformer());
    }
}
