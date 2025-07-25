{{-- resources\views\frontend\instructor-dashboard\course\content.blade.php --}}
@extends('frontend.instructor-dashboard.course.app')

@section('course_content')
<div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
    <form action="" class="course_form more_info_form">
        @csrf
        <input type="hidden" name="id" value="{{ request()?->id }}">
        <input type="hidden" name="current_step" value="3">
        <input type="hidden" name="next_step" value="4">
    </form>
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <a class="common_btn dynamic__modal__btn" href="#" data-course-id="{{ $courseId }}">Add New Chapter</a>
            <a class="common_btn sort__chapter__btn" data-course-id="{{ $courseId }}" href="">Sort Chapter</a>
        </div>
        <div class="accordion" id="accordionExample">
            @foreach ($chapters as $chapter)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $chapter->id }}"
                            aria-expanded="true" aria-controls="collapse-{{ $chapter->id }}">
                            <span>{{ $chapter->title }}</span>
                        </button>
                        <div class="add_course_content_action_btn">
                            <div class="dropdown">
                                <div class="btn btn-secondary dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="far fa-plus"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item add__lesson" href="javascript:;"
                                            data-course-id="{{ $chapter->course_id }}"
                                            data-chapter-id="{{ $chapter->id }}">
                                            Add Lesson
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <a class="edit edit__chapter" data-course-id="{{ $chapter->course_id }}" data-chapter-id="{{ $chapter->id }}" href="#"><i
                                    class="far fa-edit"></i></a>
                            <a class="del delete__item" href="{{ route('instructor.content.delete-chapter', $chapter->id) }}"><i
                                    class="fas fa-trash-alt"></i></a>
                        </div>
                    </h2>
                    <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="item_list sortable__list">
                                @foreach ($chapter->lessons ?? [] as $lesson)
                                <li data-lesson-id="{{ $lesson->id }}" data-chapter-id="{{ $chapter->id }}">
                                    <span>{{ $lesson->title }}</span>
                                    <div class="add_course_content_action_btn">
                                        <a class="edit__lesson" href="#" data-lesson-id="{{ $lesson->id }}" data-course-id="{{ $chapter->course_id }}"
                                            data-chapter-id="{{ $chapter->id }}"><i class="far fa-edit"></i></a>
                                        <a class="del delete__item" href="{{ route('instructor.content.destroy-lesson', $lesson->id) }}"><i
                                                class="fas fa-trash-alt"></i></a>
                                        <a class="arrow dragger" href="javascript:; "><i
                                                class="fas fa-arrows-alt"></i></a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
