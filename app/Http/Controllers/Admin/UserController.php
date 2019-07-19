<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\BlackList;
use App\Models\Company;
use App\Models\CompanyBaseData;
use App\Models\CompanyExt;
use App\Models\CompanyGallery;
use App\Models\CompanySub;
use App\Models\Exclusive;
use App\Models\Region;
use App\Models\Search;
use App\Models\TransferLine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;

class UserController extends Controller
{
    /**
     * 会员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $app = app();
//        $log = $app->make('log');
//        $log->info("post_index",['data'=>'this is post index']);

        log::info("post_index",['data'=>'this is post index']);

        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
            'type' => $request->input('type', ''),
        ];
        $lists = User::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->when($params['type'], function ($query) use ($params) {
                return $query->where('type', $params['type']);
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.user.index', compact('lists', 'params'));
    }

    /**
     * 添加会员
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request, User $user)
    {
        $user->fill(array_merge($request->except('password'), [
            'password' => bcrypt($request->password),
        ]));
        if ($user->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑会员
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'))->render();
    }


    /**
     * 更新会员
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request)
    {
        $user = User::find($request->input('id'));
        $user->fill($request->except('password'));
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        if ($user->save()) {
            return self::success('更新成功');
        }
        return self::error('更新失败');
    }

    /**
     * 删除会员
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return self::success();

        } catch (\Exception $exception) {

            DB::rollBack();
            return self::error($exception->getMessage() ?? '');
        }
    }
}
