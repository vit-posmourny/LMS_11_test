// resources\js\frontend\course.js
const baseInfoUrl = $(`meta[name="base_url"]`).attr('content');
const basic_info_url = baseInfoUrl + '/instructor/courses/create';
const update_url = baseInfoUrl + '/instructor/courses/update';

// Create an instance of Notyf
var notyf = new Notyf({
    duration: 5000,
    dismissible: true
});

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

        },
        complete: function() {

        },
    })
});


// show/hide VideoPath input depending on source
$('.storage').on('change', function()
{
    let value = $(this).val();
    if (value == 'upload')
    {
        $('.upload_source').removeClass('d-none');
        $('.external_source').addClass('d-none');
    }else {
        $('.upload_source').addClass('d-none');
        $('.external_source').removeClass('d-none');
    }
});
