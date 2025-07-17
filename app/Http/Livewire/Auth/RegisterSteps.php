<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Jobs\SendUserRegisteredEmail;
use App\Mail\UserRegistered;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class RegisterSteps extends Component
{
    use PasswordValidationRules;

    public ?User $user = null;
    public $passwordStrengthMessage = '';
    public $passwordStrengthClass = '';
    protected $listeners = ['phoneNumberUpdated'];

   

    public array $form = [
        'first_name'                  => '',
        'last_name'                  => '',
        'email'                 => '',
        'phone'              => '',
        'password'              => '',
        'terms'              => '',
        'gender'              => '',

    ];


    protected function rules(): array
    {
        return [
            'form.first_name' => ['required', 'string', 'max:255'],
            'form.last_name' => ['required', 'string', 'max:255'],
            'form.email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user?->id)->whereNull('deleted_at')
            ],
            'form.phone' => ['required', 'string','regex:/^(\+\d{1,3})?\d+$/', Rule::unique('users', 'phone')->ignore($this->user?->id)->whereNull('deleted_at')],
            'form.gender' => ['required', 'in:male,female'],
            'form.password' => $this->passwordRules(),
            'form.terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];
    }


    protected $validationAttributes = [
        'form.first_name' => 'first name',
        'form.last_name' => 'last name',
        'form.email' => 'email',
        'form.password' => 'password',
        'form.terms' => 'terms',
        'form.phone' => 'phone number',
        'form.gender' => 'gender',

    ];

    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.phone.regex' => 'Please enter a valid phone number.',
        'form.phone.unique' => 'You have already added this phone number!',
    ];
    
    public function phoneNumberUpdated($phoneNumber)
    {
        // dd($phoneNumber);
        $this->form['phone'] = $phoneNumber;
    }
    public function updatedFormPassword()
    {
        $password = $this->form['password'];
        $strongPasswordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

        if (preg_match($strongPasswordRegex, $password)) {
            $this->passwordStrengthMessage = 'Strong password';
            $this->passwordStrengthClass = 'strong-password';
        } else {
            $this->passwordStrengthMessage = 'Weak password';
            $this->passwordStrengthClass = 'weak-password';
        }
    }

    private function resetInputFields()
    {

        $this->form['first_name'] = '';
        $this->form['last_name'] = '';
        $this->form['email'] = '';
        $this->form['phone'] = '';
        $this->form['password'] = '';
        $this->form['gender'] = '';
    }

    public function store(CreatesNewUsers $creator)
    {
        $this->validate();
        $input = $this->form;
        event(new Registered($user = $creator->create($input)));

        Mail::to($user->email)->send(new UserRegistered($user));

        Auth::login($user);
        return app(RegisterResponse::class);
    }

    public function mount()
    {
        $this->user = Auth::user(); 
    }

    public function render()
    {
        return view('livewire.auth.register-steps');
    }
}
