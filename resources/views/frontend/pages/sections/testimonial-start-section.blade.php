<!-- resources\views\frontend\pages\sections\testimonial-start-section.blade.php -->
<section class="wsus__testimonial pt_120 xs_pt_80">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp">
                <div class="wsus__section_heading mb_40">
                    <h5>Testimonial</h5>
                    <h2>Comments From Our Learners</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row testimonial_slider">
        <div class="col-xl-4 wow fadeInUp">
            @foreach ($testimonials as $testimonial)
                <div class="wsus__single_testimonial">
                    <p>
                        @for ($i = 1; $i <= $testimonial->rating; $i++)
                            <svg class="icon-star">
                                <use href="{{ asset('fontawesome-free-7.0.1-web/sprites-full/solid.svg') }}#star"></use>
                            </svg>
                        @endfor
                    </p>
                    <p class="description">{{ $testimonial->review }}</p>
                    {{-- <div class="testimonial_logo">
                        <img src="{{ Vite::asset('resources/images/testimonial_logo.png') }}" alt="Testimonial" class="img-fluid">
                    </div> --}}
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset($testimonial->user_image) }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            {{ $testimonial->user_name }}
                            <span>{{ $testimonial->user_title }}</span>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
