<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrivateMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $messageId;
    public $message;
    public $senderId;
    public $socketId;
    public $senderName;
    public $sentTime;

    public function __construct($messageId, $message, $senderId, $socketId, $senderName, $sentTime)
    {
        $this->messageId = $messageId;
        $this->message = $message;
        $this->senderId = $senderId;
        $this->socketId = $socketId;
        $this->senderName = $senderName;
        $this->sentTime = $sentTime;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['PrivateMessageChannel'];
    }
}
