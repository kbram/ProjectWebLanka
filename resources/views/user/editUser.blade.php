<x-app-layout>
     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             Users / {{ $user->id }} / edit
         </h2>
     </x-slot>
 
     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             <div class=" pt-0 mt-0">
 
                 @if (session('success'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>Success!</strong> {{ session()->get('success') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                 @elseif (session('error'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <strong>Failed!</strong> {{ session()->get('error') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                 @endif
             </div>
             <div class="p-4 sm:p-8  dark:bg-gray-800 shadow sm:rounded-lg">
                 <header>
                     <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                         {{ __('Update User') }}
                     </h2>
                 </header>
                 <form method="post" action="{{ route('updateUser', $user->id) }}" class="mt-6 space-y-6">
                     @csrf
                    
                     <div class="row">
                         <div class="col-6">
                             <x-input-label for="name" :value="__('Name')" />
                             <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                 :value="old('name', $user->name)" required autofocus autocomplete="name" />
                             <x-input-error class="mt-2" :messages="$errors->get('name')" />
                         </div>
 
                         <div class="col-6">
                             <x-input-label for="email" :value="__('Email')" />
                             <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                 :value="old('email', $user->email)" required readonly autocomplete="username" />
                             <x-input-error class="mt-2" :messages="$errors->get('email')" />
 
 
                         </div>
 
                         <!-- Contact Number -->
                         <div class="col-6 mt-4">
                             <x-input-label for="contact_number" :value="__('Contact No')" />
                             <x-text-input id="contact_number" class="block mt-1 w-full" type="tel"
                                 name="contact_number" :value="old('contact_number', $user->contact_number)" required autocomplete="contact_number" />
                             <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                         </div>
                         <!-- Home Address -->
                         <div class="col-6 mt-4">
                             <x-input-label for="home_address" :value="__('Home Address')" />
                             <x-text-input id="home_address" class="block mt-1 w-full" type="text" name="home_address"
                                 :value="old('home_address', $user->home_address)" required autofocus autocomplete="home_address" />
                             <x-input-error :messages="$errors->get('home_address')" class="mt-2" />
                         </div>
                     </div>
 
 
                     <div class="flex justify-content-end items-center gap-4">
                         <x-primary-button>{{ __('Update') }}</x-primary-button>
                     </div>
                 </form>
 
             </div>
         </div>
     </div>
 </x-app-layout>
 