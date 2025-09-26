{{-- <div>
  <div>
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(200, 216, 250, 0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <h5>Select a user to share</h5>
                <select wire:model="selectedUser" class="form-control mb-3">
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                <button wire:click="sendPost" class="btn btn-primary w-100">Send Post</button>
                <button onclick="Livewire.dispatch('closeModal')" class="btn btn-secondary w-100 mt-2">Cancel</button>
            </div>
        </div>
    </div>
</div>

</div> --}}
