<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Jobs\SendUserRegisteredEmail;
use App\Mail\UserRegistered;
use App\Models\MemberRegister as ModelsMemberRegister;
use App\Models\User;
use App\Services\SmsService;
use Livewire\Component;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class MemberRegister extends Component
{
    use PasswordValidationRules;

    public ?User $user = null;
    public $passwordStrengthMessage = '';
    public $passwordStrengthClass = '';

    public array $form = [
        'first_name'                  => '',
        'last_name'                  => '',
        'email'                 => '',
        'phone'              => '',
        'password'              => '',
        'terms'              => '',
        'member_type'              => '',
        'slmc_number'              => '',

    ];


    protected function rules(): array
    {
        return [
            'form.first_name' => ['required', 'string', 'max:255'],
            'form.last_name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users', 'email')->ignore($this->user?->id)->whereNull('deleted_at')],
            'form.phone' => ['required', 'string', 'regex:/^(\+\d{1,3})?\d+$/',Rule::unique('users', 'phone')->ignore($this->user?->id)->whereNull('deleted_at')],
            'form.password' => $this->passwordRules(),
            'form.member_type' => ['required', 'in:doctor,service-provider,hotel'],
            'form.slmc_number' => ['required_if:form.member_type,doctor', 'string', 'max:255'],
            'form.terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];
    }

    protected $validationAttributes = [
        'form.first_name' => 'first name',
        'form.last_name' => 'last name',
        'form.email' => 'email',
        'form.phone' => 'phone number',
        'form.password' => 'password',
        'form.terms' => 'terms',
        'form.member_type' => 'member type',
        'form.slmc_number' => 'SLMC number',

    ];

    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.phone.regex' => 'Please enter a valid phone number.',
        'form.phone.unique' => 'You have already added this phone number!',
    ];

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
        $this->form['member_type'] = '';
        $this->form['slmc_number'] = '';
    }

    public function store()
    {
        $this->validate();

        $this->form['name'] = $this->form['first_name'] . " " . $this->form['last_name'];
        $input = $this->form;
        $isHotel = $input['member_type'] === 'hotel' ? 1 : 0;
        $role = $input['member_type'] === 'hotel' ? 'customer' : 'service-provider';
        $this->user = DB::transaction(function () use ($input, $isHotel, $role) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'member_type' => $input['member_type'],
                'is_hotel' => $isHotel,
                'slmc_number' => $input['slmc_number'],
                'password' => Hash::make($input['password']),
            ]),  function (User $user) use ($input, $role) {
                if ($input['member_type'] === 'doctor') {
                    $user->givePermissionTo('doctor');
                } elseif ($input['member_type'] === 'service-provider') {
                    $user->givePermissionTo('service-provider');
                }
                $user->assignRole($role);

                $memberRegister = new ModelsMemberRegister();
                $memberRegister['user_id'] = $user->id;
                $memberRegister->save();

                Mail::to($user->email)->send(new UserRegistered($user));
                
                Auth::login($user);
            });
        });
        return app(RegisterResponse::class);
    }

    public function mount()
    {
        $this->user = Auth::user(); 
    }

    public function render()
    {
        return view('livewire.auth.member-register');
    }
}
