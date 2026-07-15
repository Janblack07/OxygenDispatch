<section>
    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
    >
        @csrf
        @method('PATCH')

        <div class="profile-form-grid">

            {{-- Nombre --}}
            <div>
                <label
                    for="name"
                    class="profile-form-label"
                >
                    Nombre
                    <span class="profile-required">*</span>
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    class="profile-form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                    required
                    autofocus
                    autocomplete="name"
                >

                @error('name')
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label
                    for="email"
                    class="profile-form-label"
                >
                    Email
                    <span class="profile-required">*</span>
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    class="profile-form-control {{ $errors->has('email') ? 'has-error' : '' }}"
                    required
                    autocomplete="username"
                >

                @error('email')
                    <p class="profile-form-error">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

        @if(
            $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
            && ! $user->hasVerifiedEmail()
        )
            <div class="profile-verification-box">
                <strong>
                    Tu dirección de correo electrónico aún no está verificada.
                </strong>

                <div style="margin-top: 4px;">
                    Puedes solicitar un nuevo enlace de verificación.

                    <button
                        form="send-verification"
                        class="profile-verification-button"
                    >
                        Reenviar correo de verificación
                    </button>
                </div>

                @if(session('status') === 'verification-link-sent')
                    <p class="profile-verification-success">
                        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                    </p>
                @endif
            </div>
        @endif

        <div class="profile-form-footer">
            @if(session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="profile-saved-message"
                >
                    Cambios guardados correctamente.
                </p>
            @endif

            <button
                type="submit"
                class="profile-save-button"
            >
                Guardar cambios
            </button>
        </div>
    </form>
</section>
