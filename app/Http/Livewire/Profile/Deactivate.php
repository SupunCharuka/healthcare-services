<?php

namespace App\Http\Livewire\Profile;

use App\Models\Inquiry;
use App\Models\User;
use Livewire\Component;

class Deactivate extends Component
{
    public $confirmingUserDeactivate = false;
    public $password;

    public function confirmUserDeactivate()
    {
        $this->resetErrorBag();
        $this->confirmingUserDeactivate = true;
    }

    public function deactivateUser()
    {
        $this->validate([
            'password' => 'required',
        ]);

        $user = auth()->user();
        $approvedInquiries = Inquiry::whereRelation('invoice', 'paid', 1)
            ->where('member_status', 'completed')->exists();
        if ($approvedInquiries) {
            $this->addError('password', 'Your account cannot be deactivated due to paid inquiries.');
        } else {
            if ($user && \Hash::check($this->password, $user->password)) {
                $user->deactivated_at = now();
                $user->fcm_token = null;
                $user->save();

                if ($user->inquiries) {
                    $user->inquiries()->where('member_status', 'pending')->update(['member_status' => 'rejected']);
                }

                if ($user->services) {
                    $user->services()->update(['status' => 'rejected']);
                }

                if ($user->tickets) {
                    $user->tickets()->update(['status' => 'close']);
                }

                \Auth::guard('web')->logout();
                return redirect()->route('login')->with('error', 'Your account has been deactivated.');
            } else {
                $this->addError('password', 'Password is incorrect.');
            }
        }
    }
    public function render()
    {
        return view('livewire.profile.deactivate');
    }
}
