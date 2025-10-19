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
                error: function() {
                }
            });
        }
    });
});


// GRABBING BG IMAGE IN CERTIFICATE BUILDER
$(function() {
    const overflowElement = $("._div_overflow");
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

        const x = e.pageX - this.offsetLeft;
        const y = e.pageY - this.offsetTop;

        // Výpočet a nastavení posunu
        this.scrollLeft = scrollLeft - (x - startX);
        this.scrollTop = scrollTop - (y - startY);
    });
});
