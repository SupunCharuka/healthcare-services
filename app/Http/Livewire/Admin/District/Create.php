<?php

namespace App\Http\Livewire\Admin\District;

use App\Models\District;
use App\Models\Province;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public Province $province;

    public District $district;

    protected function rules()
    {
        return [
            'district.name' => ['required', 'unique:districts,name'],
            'district.name_si' => ['nullable', 'unique:districts,name_si'],
        ];
    }

    protected $validationAttributes = [
        'district.name' => 'district name',
        'district.name_si' => 'district name (Sinhala)',
    ];
    protected $messages = [
        'district.name.unique' => 'You have already added this district name!',
        'district.name_si.unique' => 'You have already added this district name!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->district->save();
        $this->emit('districtAdded', ["district" => $this->district]);
        $this->district = new District();
        session()->flash('message', 'Created successful!');
    }

    public function mount()
    {
        $this->district = new District();
    }
    public function render()
    {
        return view('livewire.admin.district.create');
    }
}
