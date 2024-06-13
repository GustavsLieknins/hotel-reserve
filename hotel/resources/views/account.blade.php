<x-app-layout>
    <div class="wrapper">
        @foreach($userRooms as $userRoom)
        @php
            $room = DB::table('rooms')->where('id', $userRoom->room_id)->first();
        @endphp
        <a href="/room/{{$room->id}}" class="card-a">
            <div class="card card-account">
                <div class="card-cancel">
                    <form action="/cancel/{{ $userRoom->id }}" method="POST">
                        @csrf
                        <button>Cancel</button>
                    </form>
                </div>
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
                        @if ($userRoom->status_id != 1 && $userRoom->status_id != 5 && $userRoom->status_id != 6 && $userRoom->status_id != 4)
                            <span>Room number: <span class="card-room-num-span">{{ $userRoom->room_num }}</span></span>
                            <span>|</span>
                        @endif
                        <span class="card-first-span">Status: <span class="card-room-num-span">{{ $statues[$userRoom->status_id - 1]->status }}</span></span>
                    </div>
                    <div>
                        <p class="p-checkin">Check in: <span class="card-room-num-span">{{ $userRoom->checkin }}</span></p>
                        <p>Check out: <span class="card-room-num-span">{{ $userRoom->checkout }}</span></p>
                    </div>
                    <div class="card-price">
                        <span>€{{ $room->price }}/day</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</x-app-layout>




