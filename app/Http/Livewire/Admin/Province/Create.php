<?php

namespace App\Http\Livewire\Admin\Province;

use App\Models\Province;
use Livewire\Component;

class Create extends Component
{
    public Province $province;

    protected function rules()
    {
        return [
            'province.name' => 'required|string|max:250|unique:provinces,name',
        ];
    }

    protected $validationAttributes = [
        'province.name' => 'province name',
    ];

    protected $messages = [
        'province.name.unique' => 'You have already added this province name!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->province->save();
        $this->emit('provinceAdded', ["province" => $this->province]);
        $this->province = new Province();
        session()->flash('message', 'Created successful!');
    }


    public function mount()
    {
        $this->province = new Province();
    }


    public function render()
    {
        return view('livewire.admin.province.create');
    }
}
