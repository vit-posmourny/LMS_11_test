// Variables
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const getLessonContentURL = '/student/get-lesson-content'

// htmls


// Reusable Functions

function playerHtml(source_type, source)
{

    if (source_type === 'youtube')
    {
        let player = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                          data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "${source}"}] }'>
                      </video>`;

        $('._video_holder').html(player);
    }
}

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
        success: function(data) {
            playerHtml(data.storage, data.file_path);
        },
        error: function(xhr, status, error) {},
    })
});
