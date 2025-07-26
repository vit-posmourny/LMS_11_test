@extends('admin.course.module.app')

@section('tab-content')
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form action="{{route('instructor.courses.store-basic-info')}}" method="POST" class="basic_info_form course_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="next_step" value="2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Title *</label>
                            <input type="text" name="title" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input">
                            <label for="#">Seo description</label>
                            <input type="text" name="seo_description" placeholder="Seo description">
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
                            <label for="#">Demo Video Storage <b>(optional)</b></label>
                            <select class="nice-select select_js storage" name="demo_video_storage">
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
                            <label for="#">Path</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control source_input" type="text" name="file">
                            </div>
                        </div>
                        <div class="add_course_basic_info_input external_source d-none">
                            <label for="#">Path</label>
                            <input type="text" class="source_input" name="url">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Price *</label>
                            <input type="text" name="price" placeholder="Price">
                            <p>Put 0 for free</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_input">
                            <label for="#">Discount Price</label>
                            <input type="text" name="discount_price" placeholder="Discount">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_input mb-0">
                            <label for="#">Description</label>
                            <textarea rows="8" name="description" placeholder="Description"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
