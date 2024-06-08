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

            <label for="">
            Image
                <input type="file" name="img_url">
            </label>
            <label for="">
            Location
                <input type="text" name="location" value="{{ old('location') }}">
            </label>
            <label for="">
            Availability
                <input type="number" name="availability" value="{{ old('availability') }}">
            </label>

            <button>Submit</button>
        </form>
    </div>
</x-admin-layout>

