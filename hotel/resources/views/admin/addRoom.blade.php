<x-admin-layout>
    <div class="wrapper-admin">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('room-store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="">
                Name
                <input type="text" name="name" value="{{ old('name') }}">
            </label>
            <label for="">
                Price
                <input type="number" name="price" value="{{ old('price') }}">
            </label>

            <label for="">
            Description
                <input type="text" name="description" value="{{ old('description') }}">
            </label>

            <div class="images">
                <label for="">
                    Image
                    <input type="file" name="img_url[]">
                </label>
            </div>
            <label for="">
            Location
                <input type="text" name="location" value="{{ old('location') }}">
            </label>
            <label for="">
            Availability
                <input type="number" name="availability" value="{{ old('availability') }}">
            </label>

            <button class="add-image">Add another image</button>

            <button>Submit</button>
        </form>
    </div>

    <script>
        document.querySelector('.add-image').addEventListener('click', function(event) {
            event.preventDefault();
            var imageWrapper = document.querySelector('.images');
            var newImage = document.createElement('label');
            newImage.innerHTML = '<input type="file" name="img_url[]">';
            imageWrapper.appendChild(newImage);
        });
    </script>
</x-admin-layout>


