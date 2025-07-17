<?php

namespace App\Http\Livewire\Customer\Ticket;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $document;
    public Ticket $ticket;

    protected function rules()
    {
        return [
            'ticket.title' => ['required', 'max:250'],
            'ticket.description' => ['nullable'],
            'document' =>  [Rule::requiredIf(empty($this->ticket->file)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }
    protected $validationAttributes = [
        'document' => "ticket attachments",
    ];

    public function updated()
    {
        $this->validate();
    }


    public function store()
    {
        $this->validate();
        $this->ticket['user_id'] = Auth::user()->id;
        if (!empty($this->document)) {
            $document_name = $this->document->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->document->extension();
            if (!empty($this->ticket->document)) {
                Storage::delete('uploads/service-provider/ticket/' . $this->ticket->file);
            }
            $this->document->storeAs('uploads/service-provider/ticket', $document_name);
            $this->ticket->file = $document_name;
        }
        $this->ticket->save();
        $this->document = null;
        $this->ticket = new Ticket();
        session()->flash('message', 'Ticket updated successfully!');
    }

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function render()
    {
        return view('livewire.customer.ticket.edit');
    }
}
