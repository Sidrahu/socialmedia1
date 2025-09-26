<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- 👤 Profile Image Preview -->
            <div class="mb-4 text-center">
                <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                     alt="Profile Photo"
                     class="rounded-full h-20 w-20 object-cover mx-auto shadow">
            </div>

            <!-- 📤 Upload New Image -->
            <div class="mb-4">
                <label for="profile_photo" class="block font-medium text-sm text-gray-700">Profile Image</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-input w-full mt-1" accept="image/*">
            </div>

            <!-- 👤 Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="form-input w-full rounded mt-1" required />
            </div>

            <!-- ✉️ Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-input w-full rounded mt-1" required />
            </div>

            <!-- 📝 Bio -->
            <div class="mb-4">
                <label for="bio" class="block font-medium text-sm text-gray-700">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="form-textarea w-full rounded mt-1">{{ auth()->user()->bio }}</textarea>
            </div>

            <!-- ✅ Submit -->
            <div class="flex justify-end">
               <button type="submit" class="bg-transparent text-blue-600 border border-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
    Update
</button>

            </div>
        </form>
    </div>
</x-app-layout>
