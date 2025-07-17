<?php

namespace App\Http\Livewire\Customer\Message;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $inquiries;

    public function selectMyInquiry($inquiryId)
    {
        $this->emit('selectMyInquiry', $inquiryId);
    }

    public function mount($inquiries)
    {
        $this->inquiries = $inquiries;


    }
    public function render()
    {
        return view('livewire.customer.message.index');
    }
}
