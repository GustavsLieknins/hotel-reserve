<x-admin-layout>
    <div class="wrapper">
        @if(count($reservations) == 0)
            <div class="admin-header">
                <p>No reservations</p>
            </div>
        @endif
        @foreach($reservations as $reservation)
            <div class="card-a card-a-reserve">
                <div class="card">
                    <div class="card-img">
                        @php
                            $img_urls = explode(',', $reservation->room->img_url);
                        @endphp
                        <img src="{{ $img_urls[0] }}" alt="" >
                    </div>
                    <div class="card-info">
                        <div class="card-title">
                            <h1>{{ $reservation->room->name }}</h1>
                        </div>
                        <div class="card-little-info">
                            <span class="card-first-span">{{ $reservation->room->location }}</span>
                            <span>|</span>
                            <span>{{ $reservation->room->availability }} left</span>
                        </div>
                        <div class="card-reservation">
                            <p>Reserved by: {{ \App\Models\User::find($reservation->user_id)->username }}</p>
                            <p>From: {{ $reservation->checkin }}</p>
                            <p>To: {{ $reservation->checkout }}</p>
                            <form action="{{ route('reservation-status', $reservation->id) }}" method="POST" class="form-change-status">
                                @csrf
                                <select name="status_id" id="" onchange="this.form.submit()">
                                    <option value="1" {{ $reservation->status_id == 1 ? 'selected' : '' }}>Select status</option>
                                    <option value="2" {{ $reservation->status_id == 2 ? 'selected' : '' }}>Booked</option>
                                    <option value="6" {{ $reservation->status_id == 6 ? 'selected' : '' }}>Declined</option>
                                    <option value="3" {{ $reservation->status_id == 3 ? 'selected' : '' }}>Checked in</option>
                                    <option value="4" {{ $reservation->status_id == 4 ? 'selected' : '' }}>Checked out</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-admin-layout>


