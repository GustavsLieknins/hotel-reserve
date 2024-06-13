<x-app-layout>
    <div class="wrapper card-a-book">
        <a href="/room/{{$room->id}}" class="card-a card-a-book-div">
            <div class="card-book">
                <div class="card-img-book">
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
        <div class="card-book-inputs">
                <div class="card-book-input">
                <form action="{{ route('check-date') }}" method="post" class="book-form">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}" >
                    <label for="checkin">Check-in:</label>
                    <input type="date" id="checkin" name="checkin" value="{{ old('checkin') }}" required>
                    <label for="checkout">Check-out:</label>
                    <input type="date" id="checkout" name="checkout" value="{{ old('checkout') }}" required>
                    <div class="show-book-div">
                        <button type="submit">BOOK</button>
                    </div>
                </form>
                    @if(session('false'))
                        <script>
                            alert('{{ session('false') }}');
                        </script>
                    @endif
                </div>
            </div>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</x-app-layout>


