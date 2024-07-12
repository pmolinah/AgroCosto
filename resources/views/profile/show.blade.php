<x-dashBoard>
 <div class="w-full rounded-xl border border-gray-200  py-2 mt-2 px-2 shadow-xl">
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
    <div>
        <div class="text-left max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

         {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
   
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    <!-- @livewire('profile.delete-user-form') -->
                </div>
            @endif --}}
        </div>
    </div>
    </div>
    </div>
    </div>
</x-dashBoard>
