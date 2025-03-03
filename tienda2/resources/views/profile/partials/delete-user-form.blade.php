<section class="space-y-6">
    <header>
        @if (session('idioma', 'es') == 'es')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Eliminar Cuenta') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez que elimines tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.') }}
            </p>
        @else
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        @endif
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        @if (session('idioma', 'es') == 'es')
            {{ __('Eliminar Cuenta') }}
        @else
            {{ __('Delete Account') }}
        @endif
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            @if (session('idioma', 'es') == 'es')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Una vez que elimines tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
                </p>
            @else
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            @endif

            <div class="mt-6">
                <x-input-label for="password" 
                    value="{{ session('idioma', 'es') == 'es' ? __('Contraseña') : __('Password') }}" 
                    class="sr-only" 
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ session('idioma', 'es') == 'es' ? __('Contraseña') : __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    @if (session('idioma', 'es') == 'es')
                        {{ __('Cancelar') }}
                    @else
                        {{ __('Cancel') }}
                    @endif
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    @if (session('idioma', 'es') == 'es')
                        {{ __('Eliminar Cuenta') }}
                    @else
                        {{ __('Delete Account') }}
                    @endif
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
