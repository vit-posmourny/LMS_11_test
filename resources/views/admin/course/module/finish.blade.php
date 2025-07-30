{{-- resources\views\admin\course\module\finish.blade.php --}}
@extends('admin.course.module.app')

@section('tab_content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="dashboard_add_course_finish">
            <form action="" class="more_info_form course_form">
                @csrf
                <input type="hidden" name="id" value="{{ @$course->id }}">
                <input type="hidden" name="current_step" value="4">
                <input type="hidden" name="next_step" value="4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Message for Reviewer</label>
                            <textarea rows="7" placeholder="Message for Reviewer" name="message">{!! @$course->message_for_reviewer !!}</textarea>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_input">
                            <label for="status">Status *</label>
                            <select id="status" class="nice-select" name="status" required>
                                <option value=""> Please Select </option>
                                <option @selected($course->status == "active") value="active">Active</option>
                                <option @selected($course->status == "inactive") value="inactive">Inactive</option>
                                <option @selected($course->status == "draft") value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="common_btn mt_25 mt-4">save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
