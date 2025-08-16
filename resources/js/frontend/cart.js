// resources\js\frontend\cart.js
// imports
import { notyf } from '../notyf.js';
// variables
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');


// Reusable Functions
function addToCart(courseId)
{
    $.ajax({
        method: 'POST',
        url: baseUrl + "/add-to-cart/"+ courseId,
        data: {
            _token: csrf_token,
        },
        beforeSend: function() {

        },
        success: function(data)
        {
            $('.cart_count').html(data.cart_count);
            notyf.open({
                type: 'success',
                message: data.message,
            });
        },
        error: function(xhr, status, error)
        {
            let errorMessage = xhr.responseJSON.message;
            if (xhr.status == 401){
                notyf.open({
                    type: 'warning',
                    message: errorMessage,
                });
            }else {
                notyf.open({
                    type: 'error',
                    message: errorMessage,
                });
            }
        },
        complete: function() {

        },
    });
}


// on DOM Loaded //
$(function()
{
    $('.add__to_cart').on('click', function(e)
    {
        e.preventDefault();
        let courseId = $(this).data('course-id');

        addToCart(courseId);
    })
})
