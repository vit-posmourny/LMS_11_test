{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-lesson-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary text-end">Create</button>
            </div>
        </form>
    </div>
</div>
