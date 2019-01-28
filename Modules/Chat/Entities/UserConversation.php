<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class UserConversation extends Model
{
    protected $fillable = ['user_one','user_two','conversation_id'];
}
