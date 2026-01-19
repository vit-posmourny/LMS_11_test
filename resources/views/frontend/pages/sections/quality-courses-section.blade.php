{{-- resources\views\frontend\pages\sections\quality-courses-section.blade.php --}}
<section class="wsus__quality_courses mt_120 xs_mt_100">
    <div class="row quality_course_slider">
        <div class="quality_course_slider_item" style="background: url({{ Vite::asset('resources/images/quality_courses_bg.jpg') }});">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                        <div class="wsus__quality_courses_text">
                            <div class="wsus__section_heading heading_left mb_30">
                                <h5>100% QUALITY COURSES</h5>
                                <h2>{{ $featuredInstructor->title }}</h2>
                            </div>
                            <p>{{ $featuredInstructor->subtitle }}</p>
                            <a class="common_btn" href="{{ $featuredInstructor->button_url }}">
                                {{ $featuredInstructor->button_text }}
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                        <div class="wsus__quality_courses_img">
                            <img src="{{ asset($featuredInstructor->instructor_image) }}" alt="Quality Courses" class="img-fluid w-100">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                        <div class="row quality_course_card_slider">
                        @forelse ($featuredCourses as $course)
                            <div class="col-12">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ asset($course->thumbnail) }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ Vite::asset('resources/images/love_icon_black.png') }}" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ Vite::asset('resources/images/compare_icon_black.png') }}" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ Vite::asset('resources/images/cart_icon_black_2.png') }}" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time">
                                            <svg class="icon">
                                                <use href="{{ asset('tabler/icons-sprite/tabler-sprite-filled.svg') }}#tabler-filled-clock-hour-4"></use>
                                            </svg>
                                            {{ convertMinutesToHours($course->duration) }}
                                        </span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="#">{{ $course->title }}</a>
                                        <ul>
                                            <li>24 Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ asset($course->instructor->avatar) }}" alt="Author" class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                $free
                                            @elseif ($course->discount_price > 0)
                                                <del>${{ $course->price }}</del> ${{ $course->discount_price }}
                                            @else
                                                ${{ $course->price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Data Found.</p>
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
