<?php

namespace App\Http\Livewire\ServiceProvider\BankDetails;

use App\Models\Bank;
use App\Models\BankBranch;
use App\Models\BankDetail;
use App\Models\Helper;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $bankBookImg;
    public array $listForFields = [];
    public Service $service;
    public BankDetail $account;


    protected function rules()
    {
        return [
            'account.account_holder' => ['required', 'string', 'max:255'],
            'account.account_number' => ['required', 'string', 'max:255'],
            'account.bank_id' => ['required'],
            'account.branch_id' => ['required'],
            'bankBookImg' => [Rule::requiredIf(empty($this->account->bank_book)), 'nullable', 'file', 'mimes:jpeg,bmp,png,gif,svg,pdf'],
        ];
    }

    protected $validationAttributes = [
        'account.account_holder' => 'account holder',
        'account.account_number' => 'account number',
        'account.bank_id' => 'bank name',
        'account.branch_id' => 'bank branch',
        'bankBookImg' => 'bank book image',
    ];


    public function updated()
    {
        $this->validate();
    }

    public function updatingAccountBankId($bank)
    {

        $this->listForFields['branch'] = BankBranch::where('bank_id', $bank)->orderBy('branch_name')->get();
    }


    public function save()
    {
        $this->validate();
        $this->account->service_id = $this->service->id;


        if (!empty($this->bankBookImg)) {
            $bankBookImg_name = $this->bankBookImg->getClientOriginalName() . "-" . \Str::random(20) . "-" . Carbon::now()->timestamp . '.' . $this->bankBookImg->extension();
            if (!empty($this->account->bankBookImg)) {
                Storage::delete('uploads/service-provider/bank-details/bank-book/' . $this->account->bank_book);
            }
            $this->bankBookImg->storeAs('uploads/service-provider/bank-details/bank-book', $bankBookImg_name);
            $this->account->bank_book = $bankBookImg_name;
        }
        $this->account->save();

        session()->flash('message', 'Updated successfully!');
    }

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->account = $this->service->bankDetail;
        $this->listForFields['bank'] = Bank::orderBy('bank_name')->get();
        $this->listForFields['branch'] = BankBranch::where('bank_id', $this->account->bank_id)->orderBy('branch_name')->get();
    }

    public function render()
    {
        return view('livewire.service-provider.bank-details.create');
    }
}
