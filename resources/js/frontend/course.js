// resources\js\frontend\course.js
const baseInfoUrl = $(`meta[name="base_url"]`).attr('content');
// const basic_info_url = baseInfoUrl + '/instructor/courses/create';

var csrf_token = $(`meta[name="csrf_token"]`).attr('content');

$('.basic_info_form').on('submit', function(e) {
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
        method: 'POST',
        url: baseInfoUrl,
        data: {
            formData,
            _token: csrf_token
        }
        beforeSend: function() {

        },
        beforeSend: function(data) {

        },
        beforeSend: function(xhr, status, error) {

        },
        beforeSend: function() {

        },
    })
});
