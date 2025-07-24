/** Constant Variables */

/** Reusable Functions */

function updateApproveStatus(id, status)
{
    
}

/** on DOM load */

$(function()
{
    /** change course approval status */
    $('.update-approval-status').on('change', function()
    {
        let id = $(this).data('id');
        let status = $(this).val();

        updateApproveStatus(id, status);
    })
})
