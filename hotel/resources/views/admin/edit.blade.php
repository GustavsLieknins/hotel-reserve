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

    <form method="POST" action="{{ route('room-update', $room->id) }}" class="logreg-form form-add" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="logreg-wrapper">
            <div class="logreg-title"> 
                <h1>Edit room</h1>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Name
                    </label>
                </div>
                <input type="text" name="name" value="{{ old('name', $room->name) }}" required autofocus {!! $errors->has('name') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Price
                    </label>
                </div>
                <input type="number" name="price" value="{{ old('price', $room->price) }}" required {!! $errors->has('price') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Description
                    </label>
                </div>
                <textarea name="description" required {!! $errors->has('description') ? 'class="is-invalid"' : '' !!}>{{ old('description', $room->description) }}</textarea>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Images
                    </label>
                </div>
                @foreach(old('img_url', $room->img_url ? explode(',', $room->img_url) : []) as $img)
                    <div class="image-wrapper">
                        <input type="hidden" name="old_img_url[]" value="{{ $img }}">
                        <p>{{ $img }}</p>
                        <!-- <button type="button" class="remove-image">Remove</button> -->
                    </div>
                @endforeach


                <div class="image-wrapper">
                    <input type="file" name="img_url[]">
                    <button type="button" class="add-image">Add another image</button>
                </div>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Location
                    </label>
                </div>
                <input type="text" name="location" value="{{ old('location', $room->location) }}" required {!! $errors->has('location') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-input-div">
                <div class="logreg-input-div-label">
                    <label>
                        Availability
                    </label>
                </div>
                <input type="number" name="availability" value="{{ old('availability', $room->availability) }}" required {!! $errors->has('availability') ? 'class="is-invalid"' : '' !!}>
            </div>
            <div class="logreg-submit-div">
                <div class="logreg-submit-but-div">
                    <button type="submit">Update room</button>
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
        var imageWrapper = document.querySelector('.image-wrapper:last-child');
        var newImage = imageWrapper.cloneNode(true);
        newImage.querySelector('input[type="file"]').value = null;
        imageWrapper.parentNode.appendChild(newImage);
    });

    document.querySelector('.logreg-form').addEventListener('change', function(event) {
        if (event.target.tagName === 'INPUT' && event.target.type === 'file') {
            var parent = event.target.parentNode;
            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // var img = document.createElement('img');
                    // img.src = e.target.result;
                    // parent.insertBefore(img, event.target.nextSibling);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });

    document.querySelector('.logreg-form').addEventListener('click', function(event) {
        // if (event.target.classList.contains('remove-image')) {
        //     event.target.parentNode.remove();
        // }
    });
</script>


