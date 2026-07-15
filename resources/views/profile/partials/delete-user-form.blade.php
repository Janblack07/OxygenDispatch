<section>
    <div class="profile-danger-notice">
        <div class="profile-danger-notice-content">
            <h4 class="profile-danger-notice-title">
                Eliminación permanente de cuenta
            </h4>

            <p class="profile-danger-notice-text">
                Una vez eliminada tu cuenta, los recursos y datos asociados serán eliminados permanentemente. Esta acción no se puede deshacer.
            </p>
        </div>

        <button
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="profile-danger-button"
        >
            Eliminar mi cuenta
        </button>
    </div>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="profile-modal-form"
        >
            @csrf
            @method('DELETE')

            <h2 class="profile-modal-title">
                ¿Seguro que deseas eliminar tu cuenta?
            </h2>

            <p class="profile-modal-text">
                Esta acción es permanente. Ingresa tu contraseña actual para confirmar la eliminación definitiva de tu cuenta.
            </p>

            <div class="profile-modal-field">
                <label
                    for="password"
                    class="profile-form-label"
                >
                    Contraseña actual
                    <span class="profile-required">*</span>
                </label>

                <div class="profile-password-wrapper">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="profile-form-control {{ $errors->userDeletion->has('password') ? 'has-error' : '' }}"
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                    >

                    <button
                        type="button"
                        id="toggle-delete-password"
                        class="profile-password-toggle"
                        aria-label="Mostrar contraseña"
                        title="Mostrar contraseña"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>
                    </button>
                </div>

                @foreach($errors->userDeletion->get('password') as $message)
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @endforeach
            </div>

            <div class="profile-modal-actions">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="profile-cancel-button"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="profile-danger-button"
                >
                    Eliminar definitivamente
                </button>
            </div>
        </form>
    </x-modal>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('toggle-delete-password');

            if (!passwordInput || !toggleButton) {
                return;
            }

            toggleButton.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';

                passwordInput.type = isHidden
                    ? 'text'
                    : 'password';

                toggleButton.setAttribute(
                    'aria-label',
                    isHidden
                        ? 'Ocultar contraseña'
                        : 'Mostrar contraseña'
                );

                toggleButton.setAttribute(
                    'title',
                    isHidden
                        ? 'Ocultar contraseña'
                        : 'Mostrar contraseña'
                );
            });
        });
    </script>
</section>
