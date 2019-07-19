<?php

namespace App\Transformers;

use App\Models\Authentication;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $authStatusTips = $this->get_auth_status_tips($user);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'type' => $user->type,
            'type_tips' => $this->getTypeTips($user->type),
            'avatar' => strpos($user->avatar, 'http://') === false
                ? (config('app.url') . ($user->avatar ? '/storage/' . $user->avatar : '/images/user_default_avatar.jpg'))
                : $user->avatar,
            'is_auth' => $user->is_auth,
            'auth_status' => $authStatusTips['status'],
            'auth_status_tips' => $authStatusTips['tip'],
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }

    /**
     * 获取用户类型
     * @param $type
     * @return string
     */
    private function getTypeTips($type)
    {
        switch ($type) {
            case User::TYPE_PARTNER;
                $tips = '合伙人用户';
                break;
            default:
            case User::TYPE_COMMON;
                $tips = '普通用户';
                break;
        }

        return $tips;
    }

    /**
     * 获取认证审核状态
     * @param User $user
     * @return array
     */
    private function get_auth_status_tips(User $user): array
    {
        $status = $user->authentication->status ?? null;
        switch ($status) {
            case Authentication::STATUS_WAIT_AUDIT:
                $status = 101;
                $tip = '已申请';
                break;
            case Authentication::STATUS_PASS:
                $status = 102;
                $tip = '已通过';
                break;
            case Authentication::STATUS_FAIL:
                $status = 103;
                $tip = '未通过';
                break;
            default:
                $status = 100;
                $tip = '未申请';
                break;
        }
        return compact('status', 'tip');
    }
}