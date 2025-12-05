<x-layout>
    <div class="flex items-center justify-center  bg-gradient-to-t from-gray-700 via-gray-800 to-gray-900">
<x-layouts.auth>
    <!-- Two flex box -->
    <div class="flex justify-center items-stretch gap-6 ">

        <!-- left flex box -->
    <div class="flex justify-center gap-6 w-1/2 "> 
    <div class=" border border-gray-700 bg-gray-100 rounded-3xl shadow-2xl p-8 flex flex-col justify-center h-full">
    <div class="flex flex-col gap-6 ">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
            </div>
        @endif
    </div>
</div>
</div>
        <div class="flex justify-center w-1/2 ">
             <!-- right flex box-->
        <div class="border border-gray-700 bg-gray-100 rounded-3xl shadow-2xl p-8 flex flex-col justify-start h-full">
             <x-auth-header :title="__('Don\'t have an account?')" :description="__('Sign up now to get started!')" />
        <br>
            <p class="text-center text-black">{{ __('By signing up, you\'ll be able to access') }}</p>
            <p class="text-center text-black">{{ __('you dashboard, manage your profile, ') }}</p>
            <p class="text-center text-black">{{ __('and use all available features.') }}</p>
        <br>
            <p class="text-center text-black">{{ __('With an account, you can:') }}</p>
            <p class="text-center text-black">{{ __('Save your order history') }}</p>
            <p class="text-center text-black">{{ __('Receive updates and notifications') }}</p>
            <p class="text-center text-black">{{ __('Sign up to enjoy everything we offer') }}</p>
        <br><br>
                    <flux:button variant="primary" type="button" class="w-full" wire:navigate :href="route('register')">
                        {{ __('Sign up') }}
                    </flux:button>
                    </div>
                </div>
            </div>

</x-layouts.auth>
</div>
<x-footer></x-footer>
</x-layout>
