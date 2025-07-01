// resources\js\frontend\course.js

$('.basic_info_form').on('submit', function(e) {
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
        method: 'POST',
        url: '',
        data: formData,
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
