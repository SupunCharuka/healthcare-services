<?php

namespace App\Http\Livewire\Customer\Message;

use App\Models\Inquiry;
use App\Models\InquiryConversation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatBody extends Component
{

    use WithFileUploads;
    public $selectMyInquiry;
    public $selectedMyInquiryId;
    protected $listeners = ['selectMyInquiry' => 'selectMyInquiry'];
    public $messages = [];
    public $message;
    public $attachment;
    public $lastSeen;

    public function selectMyInquiry($inquiryId)
    {
        $this->selectedMyInquiryId = $inquiryId;
        $this->selectMyInquiry = Inquiry::find($this->selectedMyInquiryId);

        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = InquiryConversation::where('inquiry_id', $this->selectedMyInquiryId)->get();
    }

    public function mount()
    {
        $this->lastSeen = $this->getLastSeenAttribute();
    }

    public function getLastSeenAttribute()
    {
        if ($this->selectMyInquiry && $this->selectMyInquiry->receiver) {
            return $this->selectMyInquiry->receiver->updated_at->diffForHumans();
        }

        return 'N/A';
    }


    public function sendMessage()
    {
        $customMessages = [
            'attachment.file' => 'The attachment must be a file.',
            'attachment.mimes' => 'The attachment must be in one of the following formats: jpeg, png, gif, mp4, pdf.',
            'message.required_if' => 'The text field is required when no attachment is provided.',
        ];

        $this->validate([
            'attachment' => 'nullable|file|mimes:jpeg,png,gif,mp4,pdf',
            'message' => 'required_if:attachment,null',
        ], $customMessages);

        if ($this->attachment) {
            if ($this->attachment->getClientOriginalExtension() === 'pdf') {
                // Handle PDF files differently
                $fileName = \Str::random(20) . "-" . $this->attachment->getClientOriginalName() . '.' . $this->attachment->extension();
                $this->attachment->storeAs('uploads/conversations', $fileName);
                $this->message = $this->attachment->getClientOriginalName();
                $type = 'file';
            } else {
                // Handle other image files
                $fileName = \Str::random(20) . "-" . $this->attachment->getClientOriginalName() . '.' . $this->attachment->extension();
                $this->attachment->storeAs('uploads/conversations', $fileName);
                $this->message = $this->attachment->getClientOriginalName();

                list($width, $height) = getimagesize($this->attachment->path());
                $type = 'image';
            }

            $message = InquiryConversation::create([
                'inquiry_id' => $this->selectedMyInquiryId,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->selectMyInquiry->service->user_id,
                'text' => $this->message,
                'status' => 'sent',
                'type' => $type,
                'name' => $this->attachment->getClientOriginalName(),
                'mime_type' => $this->attachment->getClientMimeType(),
                'attachment_name' => $fileName,
                'size' => $this->attachment->getSize(),
                'width' => $width ?? null,
                'height' => $height ?? null,
            ]);
        } else {
            $message = InquiryConversation::create([
                'inquiry_id' => $this->selectedMyInquiryId,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->selectMyInquiry->service->user_id,
                'text' => $this->message,
                'status' => 'sent',
                'type' => 'text',
            ]);
        }

        $this->message = '';
        $this->attachment = null;

        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.customer.message.chat-body');
    }
}
