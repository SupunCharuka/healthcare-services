<?php

namespace App\Http\Livewire\Member\Education;

use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Create extends Component
{
    use WithFileUploads;

    public $document;
    public Education $education;

    protected function rules()
    {
        return [
            'education.title' => ['required', 'string', 'max:255'],
            'education.start_date' => ['required', 'date'],
            'education.end_date' => ['required', 'date'],
            'document' => [Rule::requiredIf(empty($this->education->file)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'education.title' => 'title',
        'education.start_date' => 'start date',
        'education.end_date' => 'end date',
        'document' => 'certificate',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();
        $this->education['user_id'] = Auth::user()->id;
        if (!empty($this->document)) {
            $document_name = $this->document->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->document->extension();
            if (!empty($this->education->document)) {
                Storage::delete('uploads/service-provider/education/' . $this->education->file);
            }
            $this->document->storeAs('uploads/service-provider/education', $document_name);
            $this->education->file = $document_name;
        }
        if ($this->education->isDirty()) {
            $this->education->save();
            $this->emit('educationAdded', ["education" => $this->education]);
            $this->document = null;
            $this->education = new Education();
            session()->flash('message', 'Education details has been created successfully!');
           
        }
    }
    public function mount()
    {
        $this->education = new Education();
    }
    public function render()
    {
        return view('livewire.member.education.create');
    }
}
