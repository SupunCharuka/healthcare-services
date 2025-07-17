<?php

namespace App\Http\Livewire\Frontend\NewsLetter;

use App\Models\Newsletter;
use Livewire\Component;

class Index extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email|unique:newsletters',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function subscribe()
    {
        $this->validate();

        Newsletter::create(['email' => $this->email]);

        $this->reset('email');
      
    }

    public function render()
    {
        return view('livewire.frontend.news-letter.index');
    }
}
