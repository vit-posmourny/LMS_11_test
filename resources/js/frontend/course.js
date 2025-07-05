// resources\js\frontend\course.js
const baseInfoUrl = $(`meta[name="base_url"]`).attr('content');
const basic_info_url = baseInfoUrl + '/instructor/courses/create';
const update_url = baseInfoUrl + '/instructor/courses/update';

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
