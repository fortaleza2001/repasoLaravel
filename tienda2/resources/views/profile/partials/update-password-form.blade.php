<section>
    <header>
        @if (session('idioma', 'es') == 'es')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Actualizar Contraseña') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Asegúrate de que tu cuenta tenga una contraseña larga y aleatoria para mayor seguridad.') }}
            </p>
        @else
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Update Password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        @endif
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" 
                :value="session('idioma', 'es') == 'es' ? __('Contraseña Actual') : __('Current Password')" 
            />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" 
                :value="session('idioma', 'es') == 'es' ? __('Nueva Contraseña') : __('New Password')" 
            />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" 
                :value="session('idioma', 'es') == 'es' ? __('Confirmar Contraseña') : __('Confirm Password')" 
            />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ session('idioma', 'es') == 'es' ? __('Guardar') : __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ session('idioma', 'es') == 'es' ? __('Guardado.') : __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
