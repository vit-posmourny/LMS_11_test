// imports
import $ from 'jquery';
window.$ = window.jQuery = $;
import { notyf } from '../notyf-definitions.js';

const csrf_token = $('meta[name="csrf_token"]').attr('content');
const base_url = $('meta[name="base_url"]').attr('content');
var delete_url = null;


$(function() {
    $('.select2').select2();
});


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


// Certificate js
$(function()
{
    $('._draggable_element').draggable(
    {
        containment: '._certificate_boundary',
        stop: function(event, ui) {
            var elementId = $(this).attr('id');
            var x_position = ui.position.left;
            var y_position = ui.position.top;

            $.ajax({
                method: 'POST',
                url: `${base_url}/admin/certificate-item`,
                data: {
                    '_token': csrf_token,
                    'elementId': elementId,
                    'x_position': x_position,
                    'y_position': y_position,
                },
                success: function(data) {

                },
                error: function(xht, status, error) {

                },
            })
        },
    });
})

