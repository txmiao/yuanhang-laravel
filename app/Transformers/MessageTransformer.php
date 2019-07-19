<?php

namespace App\Transformers;

use App\Models\Message;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Message $message)
    {
        return [
            'id' => $message->id,
            'user_id' => $message->user_id,
            'type' => $message->type,
            'type_tips' => $this->getTypeTips($message->type),
            'title' => $message->title,
            'content' => $message->content,
            'is_read' => $message->is_read,
            'created_at' => $message->created_at->toDateTimeString(),
            'updated_at' => $message->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Message $message)
    {
        return $this->item($message->user, new UserTransformer());
    }

    /**
     * 获取消息类型
     * @param $type
     * @return string
     */
    private function getTypeTips($type)
    {
        switch ($type) {
            default:
            case Message::TYPE_USER:
                $tips = '业务消息';
                break;
            case Message::TYPE_SYSTEM:
                $tips = '系统消息';
                break;
        }

        return $tips;
    }

}