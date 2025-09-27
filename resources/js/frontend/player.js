import { notyf } from '../notyf-definitions.js';

// Variables
const _csrf_token = $(`meta[name="csrf_token"]`).attr('content');
const _baseUrl = $(`meta[name="base_url"]`).attr('content');
const _getLessonContentURL = '/student/get-lesson-content';
const _updateWatchHistory = '/student/update-watch-history';
const _updateLessonCompletion = '/student/update-lesson-completion';

// htmls


// Reusable Functions

function playerHtml(id, source_type, source, file_type)
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
    else if (source_type === 'upload' || source_type === 'external_link')
    {
        if (file_type === 'doc')
        {
            renderDocPreview(source);
            return;
        }else if (file_type === 'file')
        {
            let player = `<div class="_file_type">
                                <div class="_file_type_inner">
                                    <img src="${_baseUrl}/default-files/folder.png" alt="file_type">
                                    <div class="text-center">
                                        <h5>Type: file</h5><br>
                                        ${source_type === 'external_link' ? `<a href="${source}" target="_blank" class="btn btn-primary">Download</a>` : `<a href="${_baseUrl}/student/file-download/${id}" class="btn btn-primary">Download</a>`}
                                    </div>
                                </div>
                        </div>`;
            return player;
        }

        let player = `<iframe src="${source}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`;

        return player;
    }
}


async function renderDocPreview(url)
{
    const response = await fetch(url);

    if (!response.ok)
    {
        throw new Error(`Error: ${response.status}`);
    }

    const blob = await response.blob();

    docx.renderAsync(blob, $("._video_holder")[0])
        .then(x => console.log("docx: finished"));

}


function updateWatchHistory(courseId, chapterId, lessonId)
{
    $.ajax({
        method: 'POST',
        url: _baseUrl + _updateWatchHistory,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            '_token': _csrf_token,
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

    let checkbox = $(this).siblings('._make_complete');
    checkbox.removeClass('_inactive');

    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');

    $.ajax({
        method: 'GET',
        url: _baseUrl + _getLessonContentURL,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            '_token': _csrf_token,
        },
        beforeSend: function() {},
        success: function(data)
        {
            $('._video_holder').html(playerHtml(data.id, data.storage, data.file_path, data.file_type));

            // load _about_lecture description
            $('._about_lecture').html(data.description);
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
    let updatedAt = $(this).data('updated-at');
    console.log(updatedAt);


    $.ajax({
        method: 'POST',
        url: _baseUrl + _updateLessonCompletion,
        data: {
            'course_id': courseId,
            'chapter_id': chapterId,
            'lesson_id': lessonId,
            '_token': _csrf_token,
        },
        beforeSend: function() {},
        success: function(data)
        {
            $('#watched-in-total').html(data.watched_count);
            $('#percentage').html(data.percentage);
            $('#watched-by-chapter-'+chapterId).html(data.watched_per_lessons_by_Chapter);
        },
        error: function(xhr, status, error)
        {

        },
    })
});
