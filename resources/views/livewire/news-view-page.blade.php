<div class="news-view-container">
    <div class="news-card">
        <!-- ✅ News Header -->
        <h1 class="news-title">{{ $news->title }}</h1>
        
        <!-- ✅ Date -->
        <div class="news-meta">
            <i class="bi bi-calendar-event"></i>
            <span>{{ $news->created_at->format('d M, Y') }}</span>
        </div>

        <!-- ✅ News Content -->
        <div class="news-body">
            {!! nl2br(e($news->body)) !!}
        </div>
    </div>
    <style>
      .news-view-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
}

.news-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.news-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
}

.news-title {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 12px;
    line-height: 1.3;
}

.news-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

.news-meta i {
    color: #2563eb;
    font-size: 16px;
}

.news-body {
    font-size: 16px;
    color: #374151;
    line-height: 1.8;
    white-space: pre-line;
}

      </style>
</div>
