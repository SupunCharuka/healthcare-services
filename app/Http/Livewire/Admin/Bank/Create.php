<?php

namespace App\Http\Livewire\Admin\Bank;

use App\Models\Bank;
use Livewire\Component;

class Create extends Component
{
    public Bank $bank;
    
    protected function rules()
    {
        return [
            'bank.bank_name' => ['required', 'string', 'unique:banks,bank_name', 'max:255'],
            'bank.bank_code' => ['required', 'string', 'unique:banks,bank_code', 'max:255'],
        ];
    }

    protected $validationAttributes = [
        'bank.bank_name' => 'bank name',
        'bank.bank_code' => 'bank code',
    ];

    protected $messages = [
        'bank.bank_name.unique' => 'You have already added this name!',
        'bank.bank_code.unique' => 'You have already added this code!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->bank->save();
        $this->emit('bankAdded', ["bank" => $this->bank]);
        $this->bank = new Bank();

        session()->flash('message', 'Add Bank has been created successfully!');
    }

    public function mount()
    {
        $this->bank = new Bank();
    }

    public function render()
    {
        return view('livewire.admin.bank.create');
    }
}
