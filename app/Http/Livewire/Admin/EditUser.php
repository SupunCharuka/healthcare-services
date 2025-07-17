<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use Spatie\Permission\Models\Role;


class EditUser extends Component
{
    public User $user;
    public Role $role;
    public $role_id = [];

    public function mount($user)
    {
        $this->user = $user;

        $this->form['name']=$user->name;
        $this->form['email']=$user->email;
        $this->form['phone']=$user->phone;
        $this->form['slmc_number']=$user->slmc_number;
        $this->form['role_id']=$user->roles->first()->id ?? '';

        $this->role = new Role();

    }

    public $form = [
        'name'                  => '',
        'email'                 => '',
        'phone'              => '',
        'role_id'              => '',
        'slmc_number'              => '',
    ];

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.password' => 'mobile number',
        'form.role_id' => 'role',
        'form.slmc_number' => 'SLMC number',
    ];

    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.phone.unique' => 'You have already added this mobile number!',
        'form.phone.regex' => 'Please enter a valid phone number in the format: "+94767118525".',
    ];

    public function store()
    {
        $this->validate([
                'form.name'    => ['required', 'string', 'max:255'],
                'form.slmc_number'    => ['nullable', 'string', 'max:255'],
                'form.email'     => ['required', 'string', 'email', 'max:255',Rule::unique('users', 'email')->ignore($this->user->id, 'id')],
                'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
                'form.phone' => ['required',  'string', 'regex:/^\+\d{11}$/', Rule::unique('users', 'phone')->ignore($this->user->id, 'id')],
            ]);

            $users = User::where('id', $this->user->id)->first();
            $users->name = $this->form['name'];
            $users->email = $this->form['email'];
            $users->phone = $this->form['phone'];
            $users->slmc_number = $this->form['slmc_number'];
            $this->role_id= [$this->form['role_id']];;
            $users->roles()->sync($this->role_id);
            $users->update();

        session()->flash('message', 'User Updated Success');
    }
    public function render()
    {
        return view('livewire.admin.edit-user');
    }
}
