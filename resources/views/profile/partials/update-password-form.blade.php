<section>
    <form
        method="POST"
        action="{{ route('password.update') }}"
    >
        @csrf
        @method('PUT')

        <div class="profile-form-grid">

            {{-- Contraseña actual --}}
            <div class="profile-form-full">
                <label
                    for="update_password_current_password"
                    class="profile-form-label"
                >
                    Contraseña actual
                    <span class="profile-required">*</span>
                </label>

                <div class="profile-password-wrapper">
                    <input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="profile-form-control {{ $errors->updatePassword->has('current_password') ? 'has-error' : '' }}"
                        autocomplete="current-password"
                    >

                    <button
                        type="button"
                        class="profile-password-toggle"
                        data-password-target="update_password_current_password"
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

                @foreach($errors->updatePassword->get('current_password') as $message)
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @endforeach
            </div>

            {{-- Nueva contraseña --}}
            <div>
                <label
                    for="update_password_password"
                    class="profile-form-label"
                >
                    Nueva contraseña
                    <span class="profile-required">*</span>
                </label>

                <div class="profile-password-wrapper">
                    <input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="profile-form-control {{ $errors->updatePassword->has('password') ? 'has-error' : '' }}"
                        autocomplete="new-password"
                    >

                    <button
                        type="button"
                        class="profile-password-toggle"
                        data-password-target="update_password_password"
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

                @foreach($errors->updatePassword->get('password') as $message)
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @endforeach
            </div>

            {{-- Confirmar contraseña --}}
            <div>
                <label
                    for="update_password_password_confirmation"
                    class="profile-form-label"
                >
                    Confirmar nueva contraseña
                    <span class="profile-required">*</span>
                </label>

                <div class="profile-password-wrapper">
                    <input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="profile-form-control {{ $errors->updatePassword->has('password_confirmation') ? 'has-error' : '' }}"
                        autocomplete="new-password"
                    >

                    <button
                        type="button"
                        class="profile-password-toggle"
                        data-password-target="update_password_password_confirmation"
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

                @foreach($errors->updatePassword->get('password_confirmation') as $message)
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @endforeach
            </div>

        </div>

        <p class="profile-form-help" style="margin-top: 12px;">
            Utiliza una contraseña larga y difícil de adivinar. Evita reutilizar contraseñas de otros servicios.
        </p>

        <div class="profile-form-footer">
            @if(session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="profile-saved-message"
                >
                    Contraseña actualizada correctamente.
                </p>
            @endif

            <button
                type="submit"
                class="profile-save-button"
            >
                Actualizar contraseña
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll(
                '.profile-password-toggle[data-password-target]'
            );

            toggleButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const targetId = button.dataset.passwordTarget;
                    const input = document.getElementById(targetId);

                    if (!input) {
                        return;
                    }

                    const isHidden = input.type === 'password';

                    input.type = isHidden
                        ? 'text'
                        : 'password';

                    button.setAttribute(
                        'aria-label',
                        isHidden
                            ? 'Ocultar contraseña'
                            : 'Mostrar contraseña'
                    );

                    button.setAttribute(
                        'title',
                        isHidden
                            ? 'Ocultar contraseña'
                            : 'Mostrar contraseña'
                    );
                });
            });
        });
    </script>
</section>
