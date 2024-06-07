<x-app-layout>
    <div class="title-div">
        <h1 class="title">Hi Super Admin!</h1>
        </div>
   <div class="superadmin-wrapper">
        <div class="superadmin-div">
            <form action="/superadmin/findUser" method="GET">
                @method('GET')
                @csrf
                <div class="users-filter-wrapper">
                    <label>
                        <p>Find user by id</p>
                        <input type="number" name="user_id" value="{{ $user->id ?? "" }}">
                    </label>
                    <button>Search</button>
                </div>
            </form>
            <div class="users-wrapper">

            @if (isset($error))
                <p class="error">User not found.</p>
            @endif
                @if (isset($user))
                    <form action="/superadmin/roleChange" method="GET">
                        @method('GET')
                        @csrf
                        <div class="user-wrapper">
                            <h2 class="user-name">User: {{ $user->username }}</h2>
                            <select name="user_role" class="user-role-select" onchange="this.form.submit()">
                                <option value="">Select user role</option>
                                <option value="" {{ old('role', $user->role) == null ? 'selected' : '' }}>No admin</option>
                                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>SuperAdmin</option>
                            </select>
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                        </div>
                    </form>
                    <form action="/superadmin/userDelete" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="delete-user">Delete user</button>
                    </form>
                @endif
            </div>
    </div>
   </div>
</x-app-layout>