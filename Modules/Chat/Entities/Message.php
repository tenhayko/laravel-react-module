<?php

namespace Modules\Chat\Entities;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['messages','conversation_id','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
