<?php
namespace Modules\Chat\Traits;

trait MessageTrait
{
    public function buildConversation($conversation)
    {
        $conversation->members = $conversation->member->keyBy('user_id');
        unset($conversation->member);
        $message = [];
        $user_id = false;
        $i = 0;
        $mes = array_reverse($conversation->messages->take(50)->toArray());
        foreach ($mes as $key => $value) {
            if ($user_id && $user_id == $value['user_id']) {
                $message [$i]['user_id'] = $value['user_id'];
                $message [$i]['message'][] = $value;
            }else{
                if(array_key_exists($i,$message))
                $i++;
                $user_id = $value['user_id'];
                $message [$i]['user_id'] = $value['user_id'];
                $message [$i]['message'][] = $value;
            }
        }
        unset($conversation->messages);
        $conversation->messages = $message;
        return $conversation;
    }
}