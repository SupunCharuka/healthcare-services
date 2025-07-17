<?php

namespace App\Http\Livewire\ServiceProvider\Message;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $inquiries; 


    public function selectInquiry($inquiryId)
    {
        $this->emit('selectInquiry', $inquiryId);
    }

    public function mount($inquiries)
    {
        $this->inquiries = $inquiries;
    }
    public function render()
    {
        return view('livewire.service-provider.message.index');
    }
}
