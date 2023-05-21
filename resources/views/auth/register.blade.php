<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <!-- Name -->
            <div class="col-6">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            

            <!-- Email Address -->
            <div class="col-6 mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contact Number -->
            <div class="col-6 mt-4">
                <x-input-label for="contact_number" :value="__('Contact No')" />
                <x-text-input id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number" :value="old('contact_number')"
                    required autocomplete="contact_number" />
                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
            </div>
             <!-- Home Address -->
             <div class="col-6 mt-4">
                <x-input-label for="home_address" :value="__('Home Address')" />
                <x-text-input id="home_address" class="block mt-1 w-full" type="text" name="home_address" :value="old('home_address')"
                    required autofocus autocomplete="home_address" />
                <x-input-error :messages="$errors->get('home_address')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="col-6 mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="col-6 mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

        </div>




        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
