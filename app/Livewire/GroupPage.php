<?php

namespace App\Livewire;

use Livewire\Component;

class GroupPage extends Component
{
    public $group;

    public function mount($group)
    {
        $this->group = $group;
    }

   public function render()
{
    return view('livewire.group-page')
        ->layout('layouts.app'); // If you have layouts/app.blade.php
}

}
