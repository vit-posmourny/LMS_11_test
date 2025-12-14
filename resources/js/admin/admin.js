// IMPORTS
import $ from 'jquery';
window.$ = window.jQuery = $;
import.meta.glob(['../../images/**',]);
import { notyf } from '../notyf-definitions.js';
// CONSTANTS
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


$(function()
{
    $("._draggable_element").draggable(
    {
        containment: "._certificate_boundary",
        start: function() {
            $(this).css("cursor", "grabbing");
        },
        stop: function(event, ui)
        {
            let elementId = $(this).attr('id');
            let certBound = $("._certificate_boundary");

            if (elementId === 'signature' && $(this).data("position-saved") == 'false')
            {
                let certWidth = certBound.outerWidth();
                let certHeight = certBound.outerHeight();

                let elWidth = element.outerWidth();
                let elHeight = element.outerHeight();

                // Spočítáme pozici na střed
                let left = certWidth * 0.43 - elWidth / 2;
                let top = certHeight * 0.58 - elHeight / 2;

                $(this).css({
                    left: left + "px",
                    top: top + "px",
                });
            }

            $(this).css("cursor", "grab");
            let x = ui.position.left;
            let y = ui.position.top;
            console.log(elementId);

            $.ajax({
                method: 'POST',
                url: `${base_url}/admin/certificate-item`,
                data: {
                    _token: csrf_token,
                    element_id: elementId,
                    x_position: x,
                    y_position: y,
                    saved: 'true',
                },
                success: function() {
                },
                error: function() {
                }
            });
        }
    });
})


// GRABBING BG IMAGE IN CERTIFICATE BUILDER
$(function() {
    let overflowElement = $("._div_overflow");
    let isDown = false;
    let startX;
    let startY;
    let scrollLeft;
    let scrollTop;

    overflowElement.on("mousedown", function(e) {
        isDown = true;
        $(this).css("cursor", "grabbing");
        startX = e.pageX - this.offsetLeft;
        startY = e.pageY - this.offsetTop;
        scrollLeft = this.scrollLeft;
        scrollTop = this.scrollTop;

        // Důležité: zabránit výchozímu chování (např. výběru textu)
        e.preventDefault();
    });

    overflowElement.on("mouseleave", function() {
        isDown = false;
        $(this).css("cursor", "grab");
    });

    overflowElement.on("mouseup", function() {
        isDown = false;
        $(this).css("cursor", "grab");
    });

    overflowElement.on("mousemove", function(e) {
        if (!isDown) return;

        let x = e.pageX - this.offsetLeft;
        let y = e.pageY - this.offsetTop;

        // Výpočet a nastavení posunu
        this.scrollLeft = scrollLeft - (x - startX);
        this.scrollTop = scrollTop - (y - startY);
    });
});
