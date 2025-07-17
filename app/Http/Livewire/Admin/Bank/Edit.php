<?php

namespace App\Http\Livewire\Admin\Bank;

use App\Models\Bank;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public Bank $bank;

    protected function rules()
    {
        return [
            'bank.bank_name' => ['required', 'string', 'max:255', Rule::unique('banks', 'bank_name')->ignore($this->bank->id, 'id')],
            'bank.bank_code' => ['required', 'string', 'max:255', Rule::unique('banks', 'bank_code')->ignore($this->bank->id, 'id')],
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
        session()->flash('message', 'Bank has been updated successfully!');
        return redirect()->route('admin.bank');
    }

    public function mount(Bank $bank)
    {
        $this->bank =  $bank;
    }
    public function render()
    {
        return view('livewire.admin.bank.edit');
    }
}
