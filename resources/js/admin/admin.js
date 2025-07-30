import $ from 'jquery';
window.$ = window.jQuery = $;


// Create an instance of Notyf
var notyf = new Notyf({
    duration: 5000,
    dismissible: true,
});

const csrf_token = $('meta[name="csrf_token"]').attr('content');
var delete_url = null;

// initialize Select2 with <select> in resources/views/admin/course/module/create.blade.php
$(document).ready(function() {
    $('.select2').prop("disabled");
});

/** Delete item with confirmation */
$('.delete__item').on('click', function(e) {

    e.preventDefault();

    let url = $(this).attr('href');
    delete_url = url;

    $('#modal-danger').modal("show");
});


$('.delete-confirm').on('click', function(e) {

    e.preventDefault();

    $.ajax({
        method: 'DELETE',
        url: delete_url,
        data: {
            _token: csrf_token
        },
        beforeSend: function() {
            $('.delete-confirm').text("Deleting...");
        },
        success: function(data) {
            window.location.reload();
        },
        error: function(xhr, status, error) {
            notyf.error('Cannot delete a category with a subcategory');
            //window.location.reload();
        },
        complete: function() {
            //
        }
    })
});

