{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-lesson-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Lesson</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ @$editMode === true ? route('admin.content.update-lesson', $lesson->id) : route('admin.content.store-lesson') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $courseId }}">
            <input type="hidden" name="chapter_id" value="{{ $chapterId }}">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="add_course_basic_info_input">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ @$lesson->title }}" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="add_course_more_info_input">
                        <label for="storage">Source</label>
                        <select name="storage" class="storage nice-select select_js" required>
                            <option value="">Select</option>
                            @foreach (config('course.video_sources') as $source => $name)
                                <option @selected(@$lesson?->storage == $source) value="{{ $source }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 mb-3">
                    <div class="add_course_basic_info_input upload_source {{ @$lesson->storage == 'upload' ? '' : 'd-none' }}">
                        <label for="#" class="mb-2">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i>&nbsp; Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control source_input" type="text" name="file" value="{{ @$lesson?->file_path }}">
                        </div>
                    </div>
                    <div class="add_course_basic_info_input external_source {{ @$lesson->storage == 'upload' ? 'd-none' : '' }}">
                        <label for="#" class="mb-2">Path</label>
                        <input type="text" class="form-control source_input" name="url" value="{{ @$lesson?->file_path }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="add_course_more_info_input">
                        <label for="title">File Type</label>
                        <select name="file_type" class="nice-select select_js" required >
                            <option value="">Select</option>
                            @foreach (config('course.file_types') as $type => $name )
                                <option @selected(@$lesson?->file_type == $type) value="{{ $type }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="add_course_more_info_input">
                        <label for="duration" class="mb-2">Duration</label>
                        <input type="text" class="form-control" name="duration" value="{{ @$lesson?->duration }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="add_course_more_info_checkbox">
                        <div class="form-check">
                            <input @checked(@$lesson?->is_preview === 1) class="form-check-input" type="checkbox" value="1" name="is_preview" id="preview">
                            <label class="form-check-label" for="preview">Is Preview</label>
                        </div>
                        <div class="form-check">
                            <input @checked(@$lesson?->downloadable === 1) class="form-check-input" type="checkbox" value="1" name="downloadable" id="downloadable">
                            <label class="form-check-label" for="downloadable">Downloadable</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3 add_course_basic_info_input">
                        <label for="description">Description</label>
                        <textarea name="description" class="add_course_basic_info_input" cols="30" rows="10" required>{!! @$lesson->description !!}</textarea>
                    </div>
                </div>
                <div class="form-group text-end">
                    <button type="submit" class="btn btn-primary text-end">{{ @$editMode ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="module">
    $('#lfm').filemanager('file', {prefix: '/admin/laravel-filemanager'});
</script>
