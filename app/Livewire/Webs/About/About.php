<?php

namespace App\Livewire\Webs\About;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.webs.about.about')->layout('layouts.web');
    }
}
