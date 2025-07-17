<?php

namespace App\Http\Livewire\ServiceProvider\Availability;

use App\Models\Service;
use App\Models\WeeklyAvailability;
use Livewire\Component;

class Create extends Component
{
    public $services;
    public $week_day = [];
    public WeeklyAvailability $availability;

    protected $rules = [
        'availability.service_id' => 'required|integer',
        'week_day' => 'required|array',
        'week_day.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        'availability.start_time' => 'required',
        'availability.end_time' => 'required|after:availability.start_time',
    ];

    protected $validationAttributes = [
        'availability.service_id' => "service",
        'week_day' => "days",
        'availability.start_time' => "start time",
        'availability.end_time' => "end time",
    ];

    public function updated()
    {
        $this->validate();
    }

    public function submitForm()
    {
        $this->validate();
        foreach ($this->week_day as $day) {
            // Check for existing availabilities with overlapping time ranges on the selected day
            $existingAvailabilities = WeeklyAvailability::where('service_id', $this->availability['service_id'])
                ->where('week_day', $day)
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('start_time', '<=', $this->availability['start_time'])
                            ->where('end_time', '>=', $this->availability['start_time']);
                    })->orWhere(function ($q) {
                        $q->where('start_time', '<=', $this->availability['end_time'])
                            ->where('end_time', '>=', $this->availability['end_time']);
                    });
                })->get();


            if ($existingAvailabilities->isNotEmpty()) {
                $dayName = ucfirst($day);
                session()->flash('error', "Overlapping availability exists for $dayName. Please choose a different time range.");
                return;
            }

            $weeklyAvailability = new WeeklyAvailability();
            $weeklyAvailability->service_id = $this->availability['service_id'];
            $weeklyAvailability->start_time = $this->availability['start_time'];
            $weeklyAvailability->end_time = $this->availability['end_time'];
            $weeklyAvailability->week_day = $day;

            $weeklyAvailability->save();
        }
        $this->availability = new WeeklyAvailability();
        $this->week_day = [];
        session()->flash('message', 'Availability submitted successfully!');
        return redirect()->route('service-provider.availability.index');
    }

    public function mount($services)
    {
        $this->services = $services;
        $this->availability = new WeeklyAvailability();
    }
    public function render()
    {
        return view('livewire.service-provider.availability.create');
    }
}
