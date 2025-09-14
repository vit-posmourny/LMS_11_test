// Variables
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const getLessonContentURL = '/student/get-lesson-content'
// Reusable Functions

// On DOM Load

$('._lesson').on('click', function()
{
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');

    $.ajax({
        method: 'GET',
        url: baseUrl + getLessonContentURL,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            'csrf_token': csrf_token,
        },
        beforeSend: function() {},
        success: function(data) {},
        error: function(xhr, status, error) {},
    })
});
