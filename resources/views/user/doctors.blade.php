<div id="doctors-section" class="page-section">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
        <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
            @foreach ($doctors as $doctor)
            <div class="item">
                <div class="card-doctor shadow p-3 mb-5 bg-white rounded">
                    <div class="header">
                        <img class="rounded mx-auto d-block" loading="lazy" src="{{ asset('doctorImage/' . $doctor->image) }}" alt="{{ $doctor->name }}">
                        <div class="meta">
                            <a href="#"><span class="mai-call"></span></a>
                            <a href="#"><span class="mai-logo-whatsapp"></span></a>
                        </div>
                    </div>
                    <div class="body">
                        <p class="text-xl mb-0">Dr. {{ $doctor->name }}</p>
                        <span class="text-sm text-grey">Speciality: {{ $doctor->speciality }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
