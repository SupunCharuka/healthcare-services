<?php

namespace App\Http\Livewire\Admin\Province;

use App\Models\Province;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public Province $province;

    protected function rules()
    {
        return [
            'province.name' => ['required','string', Rule::unique('provinces', 'name')->ignore($this->province->id, 'id')],
        ];
    }

    protected $validationAttributes = [
        'province.name' => 'name',
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
        session()->flash('message', 'Updated successful!');
    }


    public function mount($province)
    {
        $this->province = $province;
    }
    public function render()
    {
        return view('livewire.admin.province.edit');
    }
}
