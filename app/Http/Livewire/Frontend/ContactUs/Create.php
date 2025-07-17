<?php

namespace App\Http\Livewire\Frontend\ContactUs;

use App\Models\ContactUs;
use Livewire\Component;

class Create extends Component
{
    public ContactUs $contactus;

    protected function rules()
    {
        return [
            'contactus.name' => ['required', 'string', 'max:255'],
            'contactus.email' => ['required', 'string','email'],
            'contactus.phone' => ['required', 'regex:/^\+\d{11}$/'],
            'contactus.subject' => ['required', 'string'],
            'contactus.message' => ['required', 'string'],
        ];
    }

    protected $validationAttributes = [
        'contactus.name' => "name",
        'contactus.email' => "email",
        'contactus.phone' => "phone",
        'contactus.subject' => "subject",
        'contactus.message' => "message",
    ];

    protected $messages = [
        'contactus.phone.regex' => 'Please enter a valid phone number in the format: "+94767118525".',
    ];

    public function updated()
    {
        $this->validate();
    }


    public function store()
    {
        $this->validate();
        $this->contactus->save();
        session()->flash('message', 'Send successfully!');
    }

    public function mount()
    {
        $this->contactus = new ContactUs();

    }

    public function render()
    {
        return view('livewire.frontend.contact-us.create');
    }
}
