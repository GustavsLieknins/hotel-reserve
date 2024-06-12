<x-app-layout>
    @php
        $imgUrls = explode(',', $room->img_url);
    @endphp
    <div class="show-wrapper">
        <div class="show-div">
            <div class="show-title-div">
                <p>{{ $room->name }}</p>
            </div>
            <div class="show-img-div">
                    <img class="active-img" src="{{ $imgUrls[0] }}" alt="">
                    <button class="img-prev" onclick="prevImg()">&lt;</button>
                    <button class="img-next" onclick="nextImg()">&gt;</button>
            </div>
            <div class="img-list">
                @foreach($imgUrls as $img_url)
                    <img class="show-img" data-img-url="{{ $img_url }}" src="{{ $img_url }}" alt="">
                @endforeach
            </div>
            <div class="show-description-div">
                <p>{{ $room->description }}</p>
            </div>
            <div class="show-info-div">
                <span class="show-availability">{{ $room->availability }} available</span>
                <span>|</span>
                <span class="show-location">{{ $room->location }}</span>
            </div>
            <div class="show-price-div">
                <p>€{{ $room->price }}/day</p>
            </div>
            <div class="show-book-div">
                <a href="{{ route('book', $room->id) }}">BOOK NOW</a>
            </div>
        </div>
    </div>
    <script>
        const imgList = document.querySelector(".img-list");
        const imgGallery = document.querySelector(".img-gallery");
        const activeImg = document.querySelector(".active-img");
        const imgPrev = document.querySelector(".img-prev");
        const imgNext = document.querySelector(".img-next");
        let imgIndex = 0;
        const imgUrls = [
            @foreach($imgUrls as $img_url)
                "{{ $img_url }}",
            @endforeach
        ];

        imgList.addEventListener("click", (event) => {
            if (event.target.tagName === "IMG") {
                const imgUrl = event.target.dataset.imgUrl;
                activeImg.src = imgUrl;
                imgIndex = Array.from(imgList.children).indexOf(event.target);
            }
        });

        function prevImg() {
            imgIndex = (imgIndex - 1 + imgUrls.length) % imgUrls.length;
            activeImg.src = imgUrls[imgIndex];
        }

        function nextImg() {
            imgIndex = (imgIndex + 1) % imgUrls.length;
            activeImg.src = imgUrls[imgIndex];
            
        }
    </script>
    <style>
        .img-list img {
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        .img-gallery {
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }
        .img-gallery img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .img-controls {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</x-app-layout>


