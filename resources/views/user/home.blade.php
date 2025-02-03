@extends('layouts.user')

@push('styles')
    <style>
        .swiper-button-next, .swiper-button-prev {
            color: #2d3b38;
        }
        .swiper-pagination-bullet-active {
            background: #2d3b38;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero d-flex justify-content-center align-items-center text-center gap-3">
        <div class="hero-content">
            <div class="pb-5">
                <span>Let's make your life happier</span>
                <h1>Healthy Living</h1>
            </div>
            <x-button-arrow class="fs-5 font-weight-bold" onclick="window.location='{{ route('appointment.make') }}'">Make Appointment</x-button-arrow>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-0 left-side">
                    <h1>Welcome to Your Health Center</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                        sed diam nonumy eirmod tempor invidunt ut labore et
                        dolore magna aliquyam erat, sed diam voluptua. At vero
                        eos et accusam et justo duo dolores et ea rebum.
                        Accusantium aperiam earum ipsa eius, inventore nemo
                        labore eaque porro consequatur ex aspernatur. Explicabo,
                        excepturi accusantium! Placeat voluptates esse ut optio
                        facilis!
                    </p>
                    <x-button-arrow>More</x-button-arrow>
                </div>
                <div class="col-lg-6 pe-lg-0 right-side">
                    <div class="carousel-container p-1 bg-light shadow">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/img/slider/blog_1.webp') }}" class="d-block w-100 carousel-img" loading="lazy">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/slider/blog_2.webp') }}" class="d-block w-100 carousel-img" loading="lazy">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/slider/blog_3.webp') }}" class="d-block w-100 carousel-img" loading="lazy">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="doctors py-5" id="doctors">
        <h1 class="text-center mb-5">Our Doctors</h1>
        <div class="slider-container">
            <div class="slider-content container py-5 swiper">
                <div class="card-wrapper swiper-wrapper">
                    @foreach ($doctors as $doc)
                        <div class="doc-card swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="doc-card-img-border">
                                    <img loading="lazy" src="{{ $doc->image ? asset('doctorImage/' . $doc->image) : asset('doctorImage/defaultImage.png') }}" alt="Doctor Image" class="doc-card-img">
                                </div>
                            </div>
                            <div class="doc-card-content">
                                <h3>Dr. {{ $doc->name }}</h3>
                                <div class="d-flex gap-2">
                                    <strong>Speciality:</strong>
                                    <span>{{ $doc->speciality }}</span>
                                </div>
                                <x-animated-btn color="#00d9a5" class="my-3">Resume</x-animated-btn>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Add navigation buttons and pagination -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Banner Section -->
    <section class="banner">
        <div class="container banner-container py-5 py-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-4 banner-img d-none d-lg-block text-center">
                    <img loading="lazy" src="{{ asset('assets/img/mobile_app.png') }}" alt="">
                </div>
                <div class="col-lg-8">
                    <h1 class="banner-h1 font-weight-normal mb-3">
                        Get easy access to all features using the One Health Application
                    </h1>
                    <a href="#">
                        <img loading="lazy" class="banner-icon mb-1 mb-sm-0 pe-2" src="{{ asset('assets/img/google_play.svg') }}" alt="">
                    </a>
                    <a href="#">
                        <img loading="lazy" class="banner-icon" src="{{ asset('assets/img/app_store.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- GSAP Animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const leftSide = document.querySelector('.left-side');
            const rightSide = document.querySelector('.right-side');
            const bannerContainer = document.querySelector('.banner-container');
            const doctorsSection = document.querySelector('.doctors');
            const heroSection = document.querySelector('.hero');
            const footer = document.querySelector('.footer-container');
            const sliderContainer = document.querySelector('.slider-container');

            function createScrollAnimation(element, x = 0, y = 50, duration = 1) {
                if (element) {
                    gsap.from(element, {
                        x,
                        y,
                        opacity: 0,
                        duration,
                        ease: "power2.out",
                        scrollTrigger: {
                            trigger: element,
                            start: "top 80%",
                            end: "top 20%",
                            toggleActions: "play none none reverse",
                        },
                    });
                }
            }

            createScrollAnimation(leftSide, -100, 0);
            createScrollAnimation(rightSide, 100, 0);
            createScrollAnimation(doctorsSection, 0, 50);
            createScrollAnimation(sliderContainer, 0, 50);
            createScrollAnimation(bannerContainer, 0, 50);
            createScrollAnimation(footer, 0, 50);

            if (heroSection) {
                gsap.from(heroSection, {
                    opacity: 0,
                    y: 50,
                    duration: 1,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: heroSection,
                        start: "top 80%",
                        end: "top 20%",
                        toggleActions: "play none none reverse",
                    },
                });
            }
        });
    </script>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".slider-content", {
                slidesPerView: 3,
                spaceBetween: 25,
                loop: true,
                fade: 'true',
                grabCursor: 'true',
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicsBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
@endpush
