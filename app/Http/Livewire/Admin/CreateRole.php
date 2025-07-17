<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Arr;

class CreateRole extends Component
{
    public Role $role;
    public $role_permissions = [];
    public Permission $permissions;

    protected function rules()
    {
        return [
            'role.name' => 'required|unique:roles,name',
        ];
    }

    protected $validationAttributes = [
        'role.name' => 'role name',
    ];

    protected $messages = [
        'role.name.unique' => 'You have already added this role!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $this->role['guard_name'] = 'web';
        $this->role->save();
        $this->emit('roleAdded', ["role" => $this->role]);
        foreach (Arr::where($this->role_permissions, fn ($val, $key) => $val) as $permission) {
            $this->role->permissions()->attach($permission);
        }
        $this->role = new Role();
        $this->role_permissions = [];
        session()->flash('message', 'Role has been created successfully!');
    }

    public function mount()
    {
        $this->role = new Role();
        $this->permissions = new Permission();
    }

    public function render()
    {
        return view('livewire.admin.create-role');
    }
}
