<x-action-section>


    <x-slot name="content">
        <div class="card-header bg-white mb-3 p-0">
            <h5>Deactivate Account</h5>
            <p> Deactivate your account.</p>
        </div>
        <div class="text-sm text-gray-600">
            {{ __('Deactivating your account is temporary. Your account will deactivated & your Inquiries, Services will be disabled. Also if your are service provider you will not show in any search results. If you need to activate the account again you will have to contact system administrator.') }}
        </div>
        

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeactivate" wire:loading.attr="disabled" class="deactivate-btn">
                {{ __('Deactivate Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeactivate">
            <x-slot name="title">
                {{ __('Deactivate Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to deactivate your account? ') }}

                <div class="mt-2" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4" autocomplete="current-password"
                        placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password"
                        wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeactivate')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deactivateUser" wire:loading.attr="disabled">
                    {{ __('Deactivate Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deactivateBtn = document.querySelector('.deactivate-btn');

        if (deactivateBtn) {
            deactivateBtn.addEventListener('click', function() {
                const stickyHeaders = document.querySelectorAll('.sticky-header');

                if (stickyHeaders.length > 0) {
                    stickyHeaders.forEach(function(stickyHeader) {
                        stickyHeader.style.display = 'none'; 
                    });
                }
            });
        }
    });
</script>
