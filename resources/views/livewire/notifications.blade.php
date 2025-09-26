<div class="notifications-container">
    <div class="notifications-card">
        <!-- Header -->
        <div class="card-header">
            <i class="bi bi-bell-fill"></i>
            <h4>All Notifications</h4>
        </div>

        <!-- Notifications List -->
        <div class="notifications-list">
            @forelse ($notifications as $notification)
                <div class="notification-item">
                    <div class="notification-content">
                        <p>{{ $notification->data['message'] }}</p>
                        @if (isset($notification->data['post_id']))
                            <a href="{{ route('post.show', $notification->data['post_id']) }}" class="view-link">
                                View Post
                            </a>
                        @endif
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-bell-slash"></i>
                    <p>You have no notifications yet.</p>
                </div>
            @endforelse
        </div>
    </div>
    <style>
        .notifications-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 0 16px;
}

.notifications-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    padding: 24px;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    border-bottom: 1px solid #f3f4f6;
    padding-bottom: 12px;
}
.card-header i {
    font-size: 22px;
    color: #2563eb;
}
.card-header h4 {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
}

.notifications-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.notification-item {
    padding: 14px 16px;
    background: #f9fafb;
    border-radius: 10px;
    transition: background 0.3s, transform 0.2s;
}
.notification-item:hover {
    background: #eef2ff;
    transform: translateX(4px);
}

.notification-content p {
    margin: 0;
    color: #374151;
    font-size: 15px;
}
.view-link {
    color: #2563eb;
    font-size: 14px;
    text-decoration: none;
    font-weight: 500;
    margin-left: 8px;
}
.view-link:hover {
    text-decoration: underline;
}

.notification-content small {
    display: block;
    color: #6b7280;
    font-size: 12px;
    margin-top: 6px;
}

.empty-state {
    text-align: center;
    color: #6b7280;
    padding: 30px 0;
}
.empty-state i {
    font-size: 40px;
    color: #d1d5db;
    margin-bottom: 10px;
}
.empty-state p {
    font-size: 14px;
}

        </style>

</div>
