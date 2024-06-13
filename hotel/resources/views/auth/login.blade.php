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

    <form method="POST" action="{{ route('login') }}" class="logreg-form">
        @csrf
        <div class="logreg-wrapper">
            <div class="logreg-title"> 
                <h1>Login</h1>
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
                        Password
                    </label>
                </div>
                <input type="password" name="password" required autocomplete="current-password" {!! $errors->has('username') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-submit-div">
                <div class="logreg-submit-but-div">
                    <button type="submit">Login</button>
                </div>
                <div>
                    <a href="{{ route('register') }}">Dont have an account?</a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

