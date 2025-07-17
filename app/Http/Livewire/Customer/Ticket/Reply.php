<?php

namespace App\Http\Livewire\Customer\Ticket;

use App\Models\Ticket;
use App\Models\TicketReply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Reply extends Component
{
    use WithFileUploads;

    public Ticket $ticket;

    public $user_role;

    public TicketReply $reply;

    public $attachment;

    protected function rules()
    {
        return [
            'reply.reply' => ['required'],
            'attachment' => ['nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }
    public function reply()
    {
        $this->validate();

        $this->reply->ticket()->associate($this->ticket);
        if ($this->user_role === 'admin') {
            $this->reply->admin()->associate(Auth::user());
            $this->ticket->status = 'hold'; // hold
            $this->ticket->save();
        } else {
            $this->reply->user()->associate(Auth::user());
            $this->ticket->status = 'open'; // open
            $this->ticket->save();
        }
        if (!empty($this->attachment)) {
            $attachment_name = $this->attachment->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->attachment->extension();
            if (!empty($this->reply->attachment)) Storage::delete('uploads/service-provider/ticket/reply/' . $this->reply->attachment);
            $this->attachment->storeAs('uploads/service-provider/ticket/reply', $attachment_name);
            $this->reply->attachment = $attachment_name;
        }
        $this->reply->save();
        $this->ticket->load('replies.user');
        $this->reply = new TicketReply();
        $this->attachment = null;
    }

    public function mount()
    {
        $this->user_role = Auth::user()->getRoleNames()->first();
        $this->reply = new TicketReply;
        $this->ticket->load('replies.user');
    }
    public function render()
    {
        return view('livewire.customer.ticket.reply');
    }
}
