{{-- resources\views\frontend\instructor-dashboard\course\partials\chapter-modal.blade.php --}}
<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Sort Chapter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="" method="">
            @csrf
            <ul class="item_list chapter__sortable__list ui-sortable">
                @foreach($chapters as $chapter)
                <li class="" data-course-id="{{ $chapter->course_id }}" data-chapter-id="{{ $chapter->id }}">
                    <span>{{ $chapter->title }}</span>
                    <div class="add_course_content_action_btn">
                        <a class="arrow dragger mt-2" href="javascript:; "><i class="fas fa-arrows-alt" aria-hidden="true"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </form>
    </div>
</div>

<script>
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const baseUrl = $(`meta[name="base_url"]`).attr('content');
if ($('.chapter__sortable__list').length)
{
    $('.chapter__sortable__list').sortable({
        items: 'li',
        containment: 'parent',
        cursor: 'pointer',
        handler: '.dragger',
        update: function(event, ui)
        {
            let orderIds = $(this).sortable('toArray', {attribute: 'data-chapter-id'})
            let chapterId = ui.item.data('chapter-id');
            let courseId = ui.item.data('course-id');

            $.ajax({
                method: 'POST',
                url: baseUrl + `/instructor/courses/content/${courseId}/sort-chapter`,
                data: {
                    _token: csrf_token,
                    orderIds: orderIds,
                },
                success: function(data) {
                    notyf.success(data.message);
                },
                error: function(xhr, statu, error) {
                    notyf.error(error);
                },
            });
        }
    });
}
</script>
