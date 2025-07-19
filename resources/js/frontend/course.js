const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const basic_info_url = baseUrl + '/instructor/courses/create';
const update_url = baseUrl + '/instructor/courses/update';



// Create an instance of Notyf
var notyf = new Notyf({
    duration: 5000,
    dismissible: true
});


var loader = `
    <div class="modal-content text-center p-3" style="display:inline">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
`;


// course tab navigation
$('.course_tab').on('click', function(e) {
    e.preventDefault();
    let step = $(this).data('step');
    $('.course_form').find(`input[name="next_step"]`).val(step);
    $('.course_form').trigger('submit');
});


$('.basic_info_form').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        method: 'POST',
        url: basic_info_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {

        },
        success: function(data) {
            if (data.status == 'success') {
                window.location.href = data.redirect;
            }
        },
        error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, value) {
                notyf.error(value[0]);
            })
        },
        complete: function() {

        },
    });
});


$('.basic_info_update_form').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        method: 'POST',
        url: update_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {

        },
        success: function(data) {
            if (data.status == 'success') {
                window.location.href = data.redirect;
            }
        },
        error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, value) {
                notyf.error(value[0]);
            })
        },
        complete: function() {

        },
    });
});


$('.more_info_form').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        method: 'POST',
        url: update_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {

        },
        success: function(data) {
            if (data.status == 'success') {
                window.location.href = data.redirect;
            }
        },
        error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, value) {
                notyf.error(value[0]);
            })
        },
        complete: function() {

        },
    });
});


// show/hide VideoPath input depending on source
$(document).on('change', '.storage', function()
{
    let value = $(this).val();
    $('.source_input').val('');
    if (value === 'upload')
    {
        $('.upload_source').removeClass('d-none');
        $('.external_source').addClass('d-none');
    }else {
        $('.upload_source').addClass('d-none');
        $('.external_source').removeClass('d-none');
    }
});



// modal showing
$('.dynamic__modal__btn').on('click', function(e) {
    e.preventDefault();
    $('#id__dynamic__modal').modal('show');

    let courseId = $(this).data('course-id');

    $.ajax({
        method: 'GET',
        url: baseUrl + '/instructor/courses/content/:id/create-chapter'.replace(':id', courseId),
        data: {},
        beforeSend: function() {
            $('.dynamic__modal__content').html(loader);
        },
        success: function(data) {
            $('.dynamic__modal__content').html(data);
        },
        error: function(xhr, status, error) {

        },
    });
});



$('.edit__chapter').on('click', function(e)
{
    e.preventDefault();
    $('#id__dynamic__modal').modal('show');

    let chapterId = $(this).data('chapter-id');

    $.ajax({
        method: 'GET',
        url: baseUrl + '/instructor/courses/content/:chapterId/edit-chapter'.replace(':chapterId', chapterId),
        data: {},
        beforeSend: function() {
            $('.dynamic__modal__content').html(loader);
        },
        success: function(data) {
            $('.dynamic__modal__content').html(data);
        },
        error: function(xhr, status, error) {

        },
    });
});



$('.add__lesson').on('click', function() {

        $('#id__dynamic__modal').modal('show');
        let courseId = $(this).data('course-id');
        let chapterId = $(this).data('chapter-id');

        $.ajax({
            method: 'GET',
            url: baseUrl + '/instructor/courses/content/create-lesson',
            data: {
                'course_id': courseId,
                'chapter_id': chapterId,
            },
            beforeSend: function() {
                $('.dynamic__modal__content').html(loader);
            },
            success: function(data) {
                $('.dynamic__modal__content').html(data);
            },
            error: function(xhr, status, error) {

            },
        });
});


$('.edit__lesson').on('click', function(e)
{
    e.preventDefault();
    $('#id__dynamic__modal').modal('show');
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');

    $.ajax({
        method: 'GET',
        url: baseUrl + '/instructor/courses/content/edit-lesson',
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
        },
        beforeSend: function() {
            $('.dynamic__modal__content').html(loader);
        },
        success: function(data) {
            $('.dynamic__modal__content').html(data);
        },
        error: function(xhr, status, error) {

        },
    });
});


if ($('.sortable__list').length)
{
    $('.sortable__list').sortable({
        items: '> li',
        containment: 'parent',
        cursor: 'pointer',
        handler: '.dragger',
        update: function(event, ui)
        {
            let orderIds = $(this).sortable('toArray', {attribute: 'data-lesson-id'})
            let chapterId = ui.item.data('chapter-id');

            $.ajax({
                method: 'POST',
                url: baseUrl + `/instructor/courses/chapter/${chapterId}/sort-lesson`,
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


$('.sort__chapter__btn').on('click', function(e)
{
    e.preventDefault();
    $('#id__dynamic__modal').modal('show');
    let courseId = $(this).data('course-id');
    $.ajax({
        method: 'GET',
        url: baseUrl + `/instructor/courses/content/${courseId}/sort-chapter`,
        data: {

        },
        beforeSend: function() {
            $('.dynamic__modal__content').html(loader);
        },
        success: function(data) {
            $('.dynamic__modal__content').html(data);
        },
        error: function(xhr, status, error) {
            notyf.error(error);
        },
    });
})
