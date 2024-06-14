<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('room-store') }}" class="logreg-form form-add" enctype="multipart/form-data">
        @csrf
        <div class="logreg-wrapper">
            <div class="logreg-title"> 
                <h1>Add a room</h1>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Name
                    </label>
                </div>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus {!! $errors->has('name') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Price
                    </label>
                </div>
                <input type="number" name="price" value="{{ old('price') }}" required {!! $errors->has('price') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Description
                    </label>
                </div>
                <input type="text" name="description" value="{{ old('description') }}" required {!! $errors->has('description') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Image
                    </label>
                </div>
                <input type="file" name="img_url[]" required {!! $errors->has('img_url') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div images">
                <div class="logreg-input-div-label">
                    <label>
                        Image
                    </label>
                </div>
                <input type="file" name="img_url[]">
            </div>
            <div class="add-image-div">
                <button class="add-image">Add another image</button>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Location
                    </label>
                </div>
                <input type="text" name="location" value="{{ old('location') }}" required {!! $errors->has('location') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Availability
                    </label>
                </div>
                <input type="number" name="availability" value="{{ old('availability') }}" required {!! $errors->has('availability') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-submit-div">
                <div class="logreg-submit-but-div">
                    <button type="submit">Add room</button>
                </div>
                <div>
                    <a href="{{ route('admin') }}">Go back</a>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

<script>
    document.querySelector('.add-image').addEventListener('click', function(event) {
        event.preventDefault();
        var imageWrapper = document.querySelector('.images');
        var newImage = document.createElement('div');
        newImage.innerHTML = '<input type="file" name="img_url[]">';
        imageWrapper.appendChild(newImage);
    });
</script>


