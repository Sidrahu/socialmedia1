 

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\User;
// use App\Models\Message; // Your Chat Message Model
// use Illuminate\Support\Facades\Auth;

// class SharePost extends Component
// {
//     public $postId;
//     public $users;
//     public $selectedUser;

//     public function mount($postId)
//     {
//         $this->postId = $postId;
//         $this->users = User::where('id', '!=', Auth::id())->get();
//     }

//     public function sendPost()
//     {
//         if ($this->selectedUser) {
//             Message::create([
//                 'from_id' => Auth::id(),
//                 'to_id' => $this->selectedUser,
//                 'body' => "Shared a post: " . route('post.show', $this->postId),
//             ]);

//             session()->flash('message', 'Post shared successfully!');
//             $this->dispatch('closeModal'); // JS event to close modal
//         }
//     }

//     public function render()
//     {
//         return view('livewire.share-post');
//     }
// }
