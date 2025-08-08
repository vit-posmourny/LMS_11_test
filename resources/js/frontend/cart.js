// variables //
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');

// Reusable Functions //
function addToCart(courseId)
{
    $.ajax({
    method: 'POST',
    url: baseUrl + `/add-to-cart/`+ courseId,
    data: {
        _token: csrf_token,
    },
    beforeSend: function() {

    },
    success: function(data) {
        $('.dynamic__modal__content').html(data);
    },
    error: function(xhr, status, error) {
        let errors = xhr.responseJSON.errors;
        $.each(errors, function(key, value) {
            notyf.error(value[0]);
        })
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
