<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatBox extends Model
{
    protected $fillable = ['senderId', 'receiverId', 'message','senderName','receiverName','hasRead'];
    protected $table = "ChatBox";
}
