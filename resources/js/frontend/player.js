// Variables
const csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const baseUrl = $(`meta[name="base_url"]`).attr('content');
const getLessonContentURL = '/student/get-lesson-content';
const _updateWatchHistory = '/student/update-watch-history';
const _updateLessonCompletion = '/student/update-lesson-completion';

// htmls


// Reusable Functions

function playerHtml(source_type, source)
{

    if (source_type === 'youtube')
    {
        let player = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                          data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "${source}"}] }'>
                      </video>`;
        return player;
    }
    else if (source_type === 'vimeo')
    {
        let player = `<video id="vid1" class="video-js" width="640" height="264"
                          data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "${source}"}], "vimeo": { "color": "#fbc51b"} }'>
                      </video>`;
        return player;
    }
    else if (source_type === 'upload' || 'external_link')
    {
        let player = `<iframe src="${source}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`;

        return player;
    }
}


function updateWatchHistory(courseId, chapterId, lessonId)
{
    $.ajax({
        method: 'POST',
        url: baseUrl + _updateWatchHistory,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            '_token': csrf_token,
        },
        beforeSend: function() {},
        success: function(data)
        {
        },
        error: function(xhr, status, error) {},
    })
}

// On DOM Load

$('._lesson').on('click', function()
{
    $('._lesson.active').removeClass('active');
    $(this).addClass('active');

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
            '_token': csrf_token,
        },
        beforeSend: function() {},
        success: function(data)
        {
            $('._video_holder').html(playerHtml(data.storage, data.file_path));
            // resetting any existing player
            if (videojs.getPlayers()['vid1']) {
                videojs.getPlayers()['vid1'].dispose();
            }
            // initializing player
            if ($('#vid1').length > 0)
                videojs('vid1').ready(function() {
                    this.play();
            })
            // update watch history
            updateWatchHistory(courseId, chapterId, lessonId);
        },
        error: function(xhr, status, error) {},
    })
});



$('._make_complete').on('click', function()
{
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');

    $.ajax({
        method: 'POST',
        url: baseUrl + _updateLessonCompletion,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            '_token': csrf_token,
        },
        beforeSend: function() {},
        success: function(data)
        {

        },
        error: function(xhr, status, error) {},
    })
});
