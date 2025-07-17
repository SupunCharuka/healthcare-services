<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class EditPermission extends Component
{
    public Permission $permission;


    protected function rules()
    {
        return [
            'permission.name' => ['required', Rule::unique('permissions', 'name')->ignore($this->permission->id, 'id')],
        ];
    }
    protected $validationAttributes = [
        'permission.name' => 'permission Name',
    ];
    protected $messages = [
        'permission.name.unique' => 'You have already added this permission!',
    ];
    public function updated()
    {
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        $this->permission->save(); 
        session()->flash('message', 'permission has been updated successfully!');
    }
    public function mount($permission)
    {
        $this->permission = $permission; 
    }
    public function render()
    {
        return view('livewire.admin.edit-permission');
    }
}
