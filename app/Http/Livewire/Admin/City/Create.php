<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\City;
use App\Models\District;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public District $district;

    public City $city;


    protected function rules()
    {
        return [
            // 'city.district_id' => 'required|exists:districts,id',
            'city.name' => ['required', 'unique:cities,name'],
            'city.name_si' => ['nullable', 'unique:cities,name_si'],
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
        $this->city->district_id = $this->district->id;
        $this->city->save();

        $this->emit('cityAdded', ["city" => $this->city, "district" => $this->district]);
        $this->city = new City();
        session()->flash('message', 'Created successfully!');
    }

    public function mount()
    {
        // dd($this->district->id);
        $this->city = new City();
        $this->city->district_id = $this->district->id;
    }

    public function render()
    {
        return view('livewire.admin.city.create');
    }
}
