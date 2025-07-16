{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Chapter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ @$editMode ? route('instructor.content.update-chapter', $chapter->id) : route('instructor.content.store-chapter', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control " name="title" value="{{ @$chapter->title }}">
            </div>
            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary text-end">{!! @$editMode ? "Update" : "Create" !!}</button>
            </div>
        </form>
    </div>
</div>
