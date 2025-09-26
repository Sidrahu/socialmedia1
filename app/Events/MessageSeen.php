<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSeen
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $messageIds;
    public $receiverId;
    /**
     * Create a new event instance.
     */
    public function __construct($messageIds, $receiverId)
    {
        $this->messageIds = $messageIds;
        $this->receiverId = $receiverId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }
}
