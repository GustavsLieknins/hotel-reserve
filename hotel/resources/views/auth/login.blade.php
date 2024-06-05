<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
                <input type="text" name="username" value="{{ old('username') }}">
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Password
                    </label>
                </div>
                <input type="password" name="password" value="{{ old('password') }}">
            </div>
            <div class="logreg-submit-div">
                <div class="logreg-submit-but-div">
                    <button type="submit">Login</button>
                </div>
                <div>
                    <a href="{{ route('register') }}">Already have an account?</a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
