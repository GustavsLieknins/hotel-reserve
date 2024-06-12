<x-admin-layout>
    <div class="wrapper">
            <div class="admin-header">
                <a href="{{ route('add-room') }}">Add rooms</a>
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
                            <p>€{{ $room->price }}/day</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
</x-admin-layout>
