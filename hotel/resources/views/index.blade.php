<x-app-layout>
    <div class="wrapper">
        <div class="search-wrapper">
            <form action="{{ route('search') }}" method="GET">
                @csrf
                <input type="text" name="search" placeholder="Search for rooms" class="search-input search-input-only" value="{{ request()->input('search') }}">
                <button type="submit" class="search-button search-button-only">Search</button>
            </form>
            <form action="{{ route('sort') }}" method="GET">
                @csrf
                <select name="sort_by" id="sort_by" class="search-input filter-input"  onchange="this.form.submit()">
                    <option value="" {{ (request()->input('sort_by') == '' ? 'selected' : '') }}>Sort by</option>
                    <option value="availability_low" {{ (request()->input('sort_by') == 'availability_low' ? 'selected' : '') }}>Availability lowest</option>
                    <option value="availability_high" {{ (request()->input('sort_by') == 'availability_high' ? 'selected' : '') }}>Availability highest</option>
                    <option value="price_low" {{ (request()->input('sort_by') == 'price_low' ? 'selected' : '') }}>Price lowest</option>
                    <option value="price_high" {{ (request()->input('sort_by') == 'price_high' ? 'selected' : '') }}>Price highest</option>
                </select>
            </form>
        </div>
        @foreach($rooms as $room)
        <a href="/room/{{$room->id}}" class="card-a">
            <div class="card">
                <div class="card-img">
                    @php
                        $img_urls = explode(',', $room->img_url);
                    @endphp
                    <img src="{{ $img_urls[0] }}" alt="" >
                </div>
                <div class="card-info">
                    <div class="card-title">
                        <h1>{{ $room->name }}</h1>
                    </div>
                    <div class="card-little-info">
                        <span class="card-first-span">{{ $room->location }}</span>
                        <span>|</span>
                        <span>{{ $room->availability }} left</span>
                    </div>
                    <div class="card-price">
                        <span>€{{ $room->price }}/day</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

        <div class="page-switch-wrapper">
            <div class="page-switch-div">
                {{ $rooms->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
</x-app-layout>



