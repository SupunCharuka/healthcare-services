<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\City;
use App\Models\District;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public District $district;

    public City $city;


    protected function rules()
    {
        return [
            'city.district_id' => 'required|exists:districts,id',
            'city.name' => ['required', Rule::unique('cities', 'name')->ignore($this->city->id, 'id')->where('district_id', $this->district->id ?? null)],
            'city.name_si' => ['nullable', Rule::unique('cities', 'name_si')->ignore($this->city->id, 'id')->where('district_id', $this->district->id ?? null)],
        ];
    }

    protected $validationAttributes = [
        'city.name' => 'city name',
        'city.name_si' => 'city name (Sinhala)',

    ];
    protected $messages = [
        'city.name.unique' => 'You have already added this city name!',
        'city.name_si.unique' => 'You have already added this city name!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->city->save();
        session()->flash('message', 'Updated successful!');
    }

    public function mount()
    {
        $this->district = $this->city->district;
    }

    public function render()
    {
        return view('livewire.admin.city.edit');
    }
}
