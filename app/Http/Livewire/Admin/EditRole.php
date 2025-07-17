<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Arr;

class EditRole extends Component
{
    public Role $role;
    public $role_permissions = [];
    public Permission $permissions;


    protected function rules()
    {
        return [
            'role.name' => ['required', Rule::unique('roles', 'name')->ignore($this->role->id, 'id')],
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
        $this->role->save(); 
        $role_permission_ids = Arr::where($this->role_permissions, fn ($val, $key) => $val);
        $this->role->permissions()->sync(array_values($role_permission_ids)); 
        session()->flash('message', 'Role has been updated successfully!');
    }
    public function mount($role)
    {
        $this->role = $role;
        $this->role_permissions = $role->permissions->pluck('id','id')->toArray();
        $this->permissions = new Permission();
    }
    public function render()
    {
        return view('livewire.admin.edit-role');
    }
}
