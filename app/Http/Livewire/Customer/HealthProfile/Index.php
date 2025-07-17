<?php

namespace App\Http\Livewire\Customer\HealthProfile;

use App\Models\HealthProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Index extends Component
{
    use WithFileUploads; 

    public HealthProfile $health;
    public $document;

    protected function rules()
    {
        return [
            'health.title' => ['required', 'string', 'max:255'],
            'document' => [Rule::requiredIf(empty($this->health->file)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'health.title' => 'title',
        'document' => 'report',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();
        $this->health['user_id'] = Auth::user()->id;
        if (!empty($this->document)) {
            $document_name = $this->document->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->document->extension();
            if (!empty($this->health->document)) {
                Storage::delete('uploads/customer/health-profile/' . $this->health->file);
            }
            $this->document->storeAs('uploads/customer/health-profile', $document_name);
            $this->health->file = $document_name;
        }
        if ($this->health->isDirty()) {
            $this->health->save();
            redirect()->route('customer.healthProfile');
            session()->flash('message', 'Created successfully!');
        }
    }
    public function mount()
    {
        $this->health = new HealthProfile();
    }

    public function render()
    {
        return view('livewire.customer.health-profile.index');
    }
}
