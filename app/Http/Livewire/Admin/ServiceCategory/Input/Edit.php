<?php

namespace App\Http\Livewire\Admin\ServiceCategory\Input;

use App\Models\Input;
use App\Models\ServiceCategory;
use Livewire\Component;

class Edit extends Component
{
    public ServiceCategory $category;
    public Input $input;

    protected function rules()
    {
        return [
            "input.name" => 'required',
            "input.type" => 'required',
            "input.placeholder" => 'required',
            "input.option" => 'nullable',
            "input.required" => 'required',
        ];
    }

    protected $validationAttributes = [
        'input.name' => 'input name',
        'input.type' => 'input type',
        'input.placeholder' => 'input placeholder',
        'input.required' => 'input required',
    ];

    public function updated()
    {
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        $this->input->save(); 
        session()->flash('message', 'Input has been updated successfully!');
    }

    public function mount($input)
    {
        $this->input = $input;
    }

    public function render()
    {
        return view('livewire.admin.service-category.input.edit');
    }
}
