<?php

function get_video_info($video) {
    $api_key = 'AIzaSyDcDa5pWMcw9OAzwmFsPjEtVoPSAsXTvd8';
    $endpoint = 'https://www.googleapis.com/youtube/v3/videos';
    $url = $endpoint . '?id=' . $video . '&key=' . $api_key . '&part=snippet,contentDetails';

    $get_video = file_get_contents($url);
	$content = json_decode($get_video, true);

    if (count($content['items']) > 0) {
        $res = $content['items'][0]['snippet'];

        return array(
            'videoID' => $video,
            'title' => iconv('utf-8', 'windows-1251', $res['title']),
            'pub_date' => $res['publishedAt'],
            'preview' => $res['thumbnails']['medium']['url'],
            'duration' => $content['items'][0]['contentDetails']['duration']
        );
    }
}

?>