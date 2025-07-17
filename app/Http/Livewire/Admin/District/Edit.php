<?php

namespace App\Http\Livewire\Admin\District;

use App\Models\District;
use App\Models\Province;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public District $district;

    protected function rules()
    {
        return [
            'district.name' => ['required', Rule::unique('districts', 'name')->ignore($this->district->id, 'id')],
            'district.name_si' => ['nullable',Rule::unique('districts', 'name_si')->ignore($this->district->id, 'id')],
        ];
    }

    protected $validationAttributes = [
        'district.name' => 'district name',
        'district.name_si' => 'district name (Sinhala)',
    ];
    protected $messages = [
        'district.name.unique' => 'You have already added this district name!',
        'district.name_si.unique' => 'You have already added this district name (Sinhala)!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->district->save();
        session()->flash('message', 'Updated successful!');
    }

    public function mount($district)
    {
        $this->district = $district;
    }
    public function render()
    {
        return view('livewire.admin.district.edit');
    }
}
