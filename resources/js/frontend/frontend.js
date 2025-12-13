// resources/js/frontend/frontend.js
// IMPORTS
import.meta.glob(['../../images/**',]);
import { notyf } from '../notyf-definitions.js';
import './cart.js';
// VARIABLES
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');

// Ez share init //
// document.addEventListener("DOMContentLoaded", function() {
//   ezShare.execute();
// });

// sweetalert2
$(".delete__item").on('click', function(e)
{
    e.preventDefault();
    let url = $(this).attr('href');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'DELETE',
                url: url,
                data: {
                    _token: csrf_token,
                },
                beforeSend: function() {

                },
                success: function() {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    notyf.error(error);
                },
                complete: function() {

                },
            });
        }
    });
});
