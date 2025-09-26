<?php

namespace App\Livewire;
use App\Models\User;

use Livewire\Component;

class UserSearch extends Component
{
 
    public $search = '';

    public function render()
    {
        $results = [];

        if (strlen($this->search) > 1) {
            $results = User::where('name', 'like', '%' . $this->search . '%')
                ->where('id', '!=', auth()->id())
                ->limit(5)
                ->get();
        }

        return view('livewire.user-search', [
            'results' => $results,
        ]);
    }
}


