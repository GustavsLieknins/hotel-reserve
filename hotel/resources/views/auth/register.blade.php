<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="logreg-errors">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="logreg-form">
        @csrf
        <div class="logreg-wrapper">
            <div class="logreg-title"> 
                <h1>Sign up</h1>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Username
                    </label>
                </div>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus {!! $errors->has('username') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Email
                    </label>
                </div>
                <input type="text" name="email" value="{{ old('email') }}" required {!! $errors->has('email') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Password
                    </label>
                </div>
                <input type="password" name="password" value="{{ old('password') }}" required autocomplete="new-password" {!! $errors->has('password') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Repeat password
                    </label>
                </div>
                <input type="password" name="password_confirmation" required autocomplete="new-password" {!! $errors->has('password') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-submit-div">
                <div class="logreg-submit-but-div">
                    <button type="submit">Register</button>
                </div>
                <div>
                    <a href="{{ route('login') }}">Already have an account?</a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

