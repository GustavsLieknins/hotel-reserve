<x-app-layout>
    <div class="wrapper">
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
    </div>
    @if(session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
</x-app-layout>



