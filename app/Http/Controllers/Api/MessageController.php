<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Transformers\MessageTransformer;

class MessageController extends Controller
{
    /**
     * 消息列表
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $user = $this->user();
        $messages = Message::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $this->response->paginator($messages, new MessageTransformer())
            ->setMeta(['notification_count' => $user->notification_count]);
    }

    /**
     * 标记消息已读状态
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function update($id)
    {
        $message = Message::findOrFail($id);
        if (!$message) {
            return $this->response->errorBadRequest();
        }
        if (Message::UNREAD == $message->is_read) {
            $message->update(['is_read' => Message::READ]);
            $user = $this->user();
            0 < $user->notification_count
                ? $user->decrement('notification_count')
                : $user->update(['notification_count' => 0]);
        }

        return $this->response->item($message, new MessageTransformer());

    }

    /**
     * 标记当前用户所有消息为已读状态
     * @return \Dingo\Api\Http\Response
     */
    public function markAllIsRead()
    {
        $user = $this->user();
        Message::where('user_id', $user->id)
            ->update(['is_read' => Message::READ]);
        $user->update(['notification_count' => 0]);

        return $this->response->noContent();
    }

    /**
     * 删除消息
     * @param $id
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->user();
        $message = Message::findOrFail($id);
        $message->delete();
        0 < $user->notification_count
            ? $user->decrement('notification_count')
            : $user->update(['notification_count' => 0]);
        return $this->response->noContent();
    }
}
