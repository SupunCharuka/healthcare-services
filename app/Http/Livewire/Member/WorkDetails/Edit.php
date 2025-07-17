<?php

namespace App\Http\Livewire\Member\WorkDetails;

use App\Models\WorkDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $document;
    public WorkDetail $workdetail;

    protected function rules()
    {
        return [
            'workdetail.title' => ['required', 'string', 'max:255'],
            'workdetail.start_date' => ['required', 'date'],
            'workdetail.end_date' => ['required', 'date'],
            'document' => [Rule::requiredIf(empty($this->workdetail->file)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'workdetail.title' => 'title',
        'workdetail.start_date' => 'start date',
        'workdetail.end_date' => 'end date',
        'document' => 'certificate',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();
       
        if (!empty($this->document)) {
            $document_name = $this->document->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->document->extension();
            if (!empty($this->workdetail->document)) {
                Storage::delete('uploads/service-provider/workDetails/' . $this->workdetail->file);
            }
            $this->document->storeAs('uploads/service-provider/workDetails', $document_name);
            $this->workdetail->file = $document_name;
        }
        if ($this->workdetail->isDirty()) {
            $this->workdetail->save();
            session()->flash('message', 'Work Details has been updated successfully!');
        }
    }
    public function mount(WorkDetail $workdetail)
    {
        $this->workdetail = $workdetail;
    }
    public function render()
    {
        return view('livewire.member.work-details.edit');
    }
}
