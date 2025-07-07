@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')
<div class="tab-pane fade show active" id="pills-home" role="tabpanel"
    aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form action="{{route('instructor.courses.store-basic-info')}}" method="POST" class="basic_info_update_form course_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="current_step" value="1">
            <input type="hidden" name="next_step" value="2">
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_basic_info_input">
                        <label for="#">Title *</label>
                        <input type="text" name="title" placeholder="Title" value="{{ $course->title }}"
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_input">
                        <label for="#">Seo description</label>
                        <input type="text" name="seo_description" placeholder="Seo description" value="{{ $course->seo_description }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_input">
                        <label for="#">Thumbnail *</label>
                        <input type="file" name="thumbnail">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_input">
                        <label for="#">Demo Video Storage<b> (optional)</b></label>
                        <select class="select_js storage" name="demo_video_storage">
                            <option value=""> Please Select </option>
                            <option value="upload" name="upload"> Upload </option>
                            <option value="youtube" name="youtube"> YouTube </option>
                            <option value="vimeo" name="vimeo"> Vimeo </option>
                            <option value="external_link" name="external_link"> external link </option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_input upload_source">
                        <label for="#">Video Path</label>
                        <input type="file" name="video_path">
                    </div>
                    <div class="add_course_basic_info_input external_source d-none">
                        <label for="#">Video Path</label>
                        <input type="text" name="video_path">
                    </div>
                     <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_input">
                        <label for="#">Price *</label>
                        <input type="number" name="price" placeholder="Price" value="{{ $course->price }}">
                        <p>Put 0 for free</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_input">
                        <label for="#">Discount Price</label>
                        <input type="number" name="discount_price" placeholder="Discount" value="{{ $course->discount_price }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_input mb-0">
                        <label for="#">Description</label>
                        <textarea rows="8" name="description" placeholder="Description">{!! $course->description !!}</textarea>
                        <button type="submit" class="common_btn mt_20">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $('#lfm').filemanager('file');
</script>
@endpush
