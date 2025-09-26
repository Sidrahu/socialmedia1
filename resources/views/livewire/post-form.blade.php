<div class="d-flex justify-content-center">
    <div class="modern-card">
        <div class="card-body">

            <!-- ✅ User Info -->
            <div class="d-flex align-items-center mb-4">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                     alt="avatar"
                     class="avatar">
                <div>
                    <h6 class="username">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">Create a new post</small>
                </div>
            </div>

            <!-- ✅ Post Form -->
            <form wire:submit.prevent="save" enctype="multipart/form-data">

                <!-- ✅ Post Text -->
                <textarea wire:model="content"
                          class="modern-textarea"
                          placeholder="What's on your mind?"
                          rows="4"></textarea>

                <!-- ✅ File Upload -->
                <div class="upload-section mb-3">
                    <label for="mediaUpload" class="upload-label">
                        <i class="bi bi-upload"></i> Upload Photo/Video
                    </label>
                    <input type="file" id="mediaUpload" wire:model="media" class="form-control" accept="image/*,video/*">
                </div>

                <!-- ✅ Media Preview -->
                @if ($media)
                    <div class="media-preview">
                        @if (str($media->getMimeType())->contains('image'))
                            <img src="{{ $media->temporaryUrl() }}" class="preview-img" />
                        @elseif (str($media->getMimeType())->contains('video'))
                            <video controls class="preview-video">
                                <source src="{{ $media->temporaryUrl() }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                @endif

                <!-- ✅ Post Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary modern-btn">
                        <i class="bi bi-send"></i> Post Now
                    </button>
                </div>

                <!-- ✅ Success Message -->
                @if (session()->has('success'))
                    <div class="alert alert-success mt-3 mb-0 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

            </form>
        </div>
    </div>


<style>
/* ✅ Modern Post Card CSS */
.modern-card {
    width: 100%;
    max-width: 720px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    padding: 24px;
    transition: 0.3s ease-in-out;
}
.modern-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}
.avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 14px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.username {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}
.modern-textarea {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 14px;
    font-size: 15px;
    color: #374151;
    resize: none;
    outline: none;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    transition: 0.3s;
}
.modern-textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
}
.upload-section {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.upload-label {
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}
.upload-label i {
    font-size: 16px;
    color: #3b82f6;
}
.media-preview {
    margin-bottom: 14px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    padding: 6px;
}
.preview-img, .preview-video {
    width: 100%;
    border-radius: 10px;
    max-height: 400px;
    object-fit: contain;
}
.modern-btn {
    border-radius: 50px;
    padding: 10px;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}
.modern-btn i {
    font-size: 18px;
}
</style>
</div>
