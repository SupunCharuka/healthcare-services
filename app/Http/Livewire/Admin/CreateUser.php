<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Arr;
use Laravel\Fortify\Rules\Password;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    use PasswordValidationRules;
    public User $user;
    public Role $role;
    public $role_id = [];

    public function mount()
    {
        $this->user = new User();
        $this->role = new Role();
    }

    public $form = [
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'role_id'              => '',
        'phone'              => '',
    ];

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.password' => 'password',
        'form.phone' => 'mobile number',
        'form.role_id' => 'role',
    ];

    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.phone.unique' => 'You have already added this mobile number!',
        'form.phone.regex' => 'Please enter a valid phone number in the format: "+94767118525".',
    ];

    private function resetInputFields()
    {

        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';
        $this->form['phone'] = '';
        $this->form['role_id'] = '';
    }

    public function store()
    {
        $this->validate([
            'form.name'    => ['required', 'string', 'max:255'],
            'form.email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.password' => $this->passwordRules(),
            'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
            'form.phone' => ['required',  'string', 'regex:/^\+\d{11}$/', 'unique:users,phone'],
        ]);
        $input = $this->form;
        $this->role_id = ['role_id' => $input['role_id']];
        $this->user = DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'phone' => $input['phone'],
            ]), function (User $user) {
                $user->roles()->sync($this->role_id);
            });
        });
        $this->emit('userAdded', ["user" => $this->user, 'role' => $this->user->getRoleNames()]);
        $this->resetInputFields();
        $this->user = new User();
        session()->flash('message', 'User Created Successfully!');
    }
    public function render()
    {
        return view('livewire.admin.create-user');
    }
}
