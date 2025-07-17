<?php

namespace App\Http\Livewire\Admin\Bank\Branch;

use App\Models\Bank;
use App\Models\BankBranch;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public Bank $bank;

    public BankBranch $branch;

    protected function rules()
    {
        return [
            'branch.branch_name' => ['required', Rule::unique('bank_branches', 'branch_name')->where('bank_id', $this->bank->id)],
            'branch.branch_code' => ['required', Rule::unique('bank_branches', 'branch_code')->where('bank_id', $this->bank->id)],
        ];
    }

    protected $validationAttributes = [
        'branch.branch_name' => 'branch name',
        'branch.branch_code' => 'branch code',
    ];

    protected $messages = [
        'branch.branch_name.unique' => 'You have already added this branch!',
        'branch.branch_code.unique' => 'You have already added this code!',
    ];

    public function mount(BankBranch $branch)
    {
        $this->branch = $branch;
        $this->branch->bank_id = $this->bank->id;
    }
  
    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->branch->bank_id = $this->bank->id;
        $this->branch->save();
        $this->emit('bankBranchAdded', ["branch" => $this->branch]);
        $this->branch = new BankBranch();
        session()->flash('message', 'Branch create successfully!');
    }
    public function render()
    {
        return view('livewire.admin.bank.branch.create');
    }
}
