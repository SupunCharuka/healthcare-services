<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Component
{
    public Permission $permission;

    protected function rules()
    {
        return [
            'permission.name' => 'required|unique:permissions,name',
        ];
    }

    protected $validationAttributes = [
        'permission.name' => 'permission name',
    ];

    protected $messages = [
        'permission.name.unique' => 'You have already added this permission!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function mount()
    {
        $this->permission = new Permission();
    }

    public function save()
    {
        $this->validate();
        $this->permission['guard_name'] = 'web';
        $this->permission->save();
        $this->emit('permissionAdded', ["permission" => $this->permission]); 
        $this->permission = new Permission();
        session()->flash('message', 'permission has been created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.create-permission');
    }
}
