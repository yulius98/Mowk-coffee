<header class="bg-[#623c32] shadow-sm">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($Product_unggulan as $unggulan )
                <div class="carousel-item active">
                    <img src="{{ asset('storage/'. $unggulan->image)}}" class="d-block w-100" alt="Unggulan">
                </div>
            @endforeach
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
</header>