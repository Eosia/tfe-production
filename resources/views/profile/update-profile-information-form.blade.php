<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_path }}" alt="{{ $this->user->firstname }} {{ $this->user->lastname }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Pseudo') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="firstname" value="{{ __('Prenom') }}" />
            <x-jet-input id="firstname" type="text" class="mt-1 block w-full" wire:model.defer="state.firstname" autocomplete="firstname" />
            <x-jet-input-error for="firstname" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="lastname" value="{{ __('Nom') }}" />
            <x-jet-input id="lastname" type="text" class="mt-1 block w-full" wire:model.defer="state.lastname" autocomplete="lastname" />
            <x-jet-input-error for="lastname" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        {{--
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="province_id" value="{{ __('Province') }}" />
            <select id="province_id" name="province_id" class="block my-2 w-full rounded border-gray-300"
                    selected required wire:model.defer="state.province_id" autocomplete="province_id" >
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}" selected >{{ $province->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="province_id" class="mt-2" />
        </div>
        --}}

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="city_id" value="{{ __('Ville') }}" />
            <select id="city_id" name="city_id" class="block my-2 w-full rounded border-gray-300"
                    selected required wire:model.defer="state.city_id" autocomplete="city_id" >
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" selected >{{ $city->name }} - {{ $city->zip }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="city_id" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="role_id" value="{{ __('Role') }}" />
            <select id="role_id" name="role_id" class="block my-2 w-full rounded border-gray-300"
                    selected required wire:model.defer="state.role_id" autocomplete="role_id" >
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="role_id" class="mt-2" />
        </div>



    </x-slot>

    {{-- changement de la province de l'user --}}



    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
