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


// Delete item with confirmation
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
        },
        complete: function() {
        }
    })
});


// Certificate
$(function()
{
    const element = $("#signature");
    const certBound = $("._certificate_boundary");

    // 🔹 1. Po načtení stránky převeď procenta na pixely (jen pokud zatím nejsou uložené pozice)
    if (element.data("position-saved") == 'false')
    {
        //const certOffset = certBound.offset();
        const certWidth = certBound.outerWidth();
        const certHeight = certBound.outerHeight();
        console.log(certWidth, certHeight);

        const elWidth = element.outerWidth();
        const elHeight = element.outerHeight();

        // Spočítáme pozici na střed
        const left = certWidth * 0.43 - elWidth / 2;
        const top = certHeight * 0.58 - elHeight / 2;

        element.css({
            left: left + "px",
            top: top + "px",
        });
    }

    // 🔹 2. Inicializuj draggable s měněním kurzoru
    element.draggable({
        containment: "._certificate_boundary",
        start: function() {
            $(this).css("cursor", "grabbing");
        },
        stop: function(event, ui) {
            $(this).css("cursor", "grab");

            const x = ui.position.left;
            const y = ui.position.top;

            // 🔹 3. AJAX uložení nové pozice do DB
            $.ajax({
                method: 'POST',
                url: `${base_url}/admin/certificate-item`,
                data: {
                    _token: csrf_token,
                    elementId: "signature",
                    x_position: x,
                    y_position: y,
                    saved: 'true',
                },
                success: function() {
                },
                error: function(err) {
                }
            });
        }
    });
});

// Certificate Builder form
$('._certificate_builder_form').on('submit', function(e)
{
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        method: 'POST',
        url: `${base_url}/admin/certificate-builder`,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {

        },
        success: function(data)
        {
            if (data.imageInfo[0] && data.imageInfo[1]) {
                // Získání elementu a nastavení nových rozměrů
                let newWidth = data.imageInfo[0];
                let newHeight = data.imageInfo[1];

                // Nastaví width a height elementu ._certificate_body přímo pomocí jQuery .css()
                // Ponechává původní CSS z 'style.css' (jako position: relative, margin: auto, atd.)
                $('._certificate_body').css({
                    'width': newWidth + 'px',
                    'height': newHeight + 'px'
                });

                if (data.status == 'success') {
                    window.location.href = data.redirect;
                }

        }},
        error: function(xhr, status, error) {
            // let errors = xhr.responseJSON.errors;
            // $.each(errors, function(key, value) {
            //     notyf.error(value[0]);
            // })
        },
        complete: function() {

        },
    });
});
