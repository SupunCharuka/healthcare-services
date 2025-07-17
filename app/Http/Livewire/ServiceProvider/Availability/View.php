<?php

namespace App\Http\Livewire\ServiceProvider\Availability;

use App\Models\Service;
use App\Models\WeeklyAvailability;
use Carbon\Carbon;
use Livewire\Component;

class View extends Component
{
    public $services;

    public function mount($services)
    {
        $this->services = $services;
    }
    

    public function deleteAvailability($availabilityId)
    {
        $availability = WeeklyAvailability::find($availabilityId);

        if ($availability) {
            $availability->delete();
    
            session()->flash('success', 'Availability deleted successfully!');
            return redirect()->route('service-provider.availability.index');
        }
    }
    public function render()
    {
        return view('livewire.service-provider.availability.view');
    }
}
