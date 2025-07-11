// resources\js\frontend\course.js
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const basic_info_url = baseUrl + '/instructor/courses/create';
const update_url = baseUrl + '/instructor/courses/update';

var loader = `
    <div class="modal-content text-center p-3" style="display:inline">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
`


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
    })
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
    })
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
    })
});


// show/hide VideoPath input depending on source
$('.storage').on('change', function()
{
    let value = $(this).val();
    $('.source_input').val('');
    if (value == 'upload')
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

    let courseId = $(this).data('id');

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
    })
});
