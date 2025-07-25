/** Constant Variables */
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
/** Reusable Functions */

function updateApproveStatus(courseId, approval)
{
    $.ajax({
        method: 'PUT',
        url: baseUrl + `/admin/courses/${courseId}/update-approval`,
        data: {
            _token: csrf_token,
            approval: approval,
        },
        success: function(data) {
            window.location.reload();
        },
        error: function(xhr, data, error) {

        },
    });
}

/** on DOM load */

$(function()
{   /** change course approval status */
    $('.update-approval-status').on('change', function()
    {
        let courseId = $(this).data('id');
        let approval = $(this).val();

        updateApproveStatus(courseId, approval);
    })
})
