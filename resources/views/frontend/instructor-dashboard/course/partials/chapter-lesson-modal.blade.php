{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-lesson-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title">Source</label>
                        <select name="" class="add_course_basic_info_input storage nice-select select_js">
                            <option value="">Select</option>
                            @foreach (config('course.video_sources') as $source => $name)
                                <option value="{{ $source }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="title">File Type</label>
                        <select name="" id="" class="add_course_basic_info_input nice-select select_js">
                            <option value="">Select</option>
                            @foreach (config('course.file_types') as $type => $name )
                                <option value="{{ $type }}">{{ $name }}</option>
                            @endforeach
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
                <div class="form-group text-end">
                    <button type="submit" class="btn btn-primary text-end">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
