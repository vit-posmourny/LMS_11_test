{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Sort Chapter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="" method="">
            @csrf
            <ul class="item_list sortable__list ui-sortable">
                @foreach($chapters as $chapter)
                <li class="mt-2">
                    <span>{{ $chapter->title }}</span>
                    <div class="add_course_content_action_btn">
                        <a class="arrow dragger" href="javascript:; "><i class="fas fa-arrows-alt" aria-hidden="true"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </form>
    </div>
</div>
