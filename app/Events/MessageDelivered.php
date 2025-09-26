<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageDelivered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message_id;
    public $receiver_id;
    /**
     * Create a new event instance.
     */
    public function __construct($message_id, $receiver_id)
    {
        $this->message_id = $message_id;
        $this->receiver_id = $receiver_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
 
    return new PrivateChannel('chat.' . $this->receiver_id);
}

    }

