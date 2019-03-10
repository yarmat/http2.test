<?php

$url = $_GET['url'];

if (is_null(parse_url($url, PHP_URL_HOST))) {
    $new_url = 'https://' . parse_url($url, PHP_URL_PATH);
} else {
    $new_url = 'https://' . parse_url($url, PHP_URL_HOST);
}

if (empty($url)) {
    echo json_encode([
        'success' => false,
        'message' => 'Url is undefined.'
    ]);
    die;
}

if (!filter_var($new_url, FILTER_VALIDATE_URL)) {
    echo json_encode([
        'success' => false,
        'message' => "$url is not a valid URL"
    ]);
    die;
}

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $new_url,
    CURLOPT_HEADER         => true,
    CURLOPT_NOBODY         => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_2_0, // cURL will attempt to make an HTTP/2.0 request (can downgrade to HTTP/1.1)
]);
$response = curl_exec($ch);


if ($response !== false && strpos($response, "HTTP/2") === 0) {
//    echo "Server of the $url has HTTP/2.0 support."; // yay!
    echo json_encode([
        'success' => true,
        'message' => "Server of the $url has HTTP/2.0 support."
    ]);
} elseif ($response !== false) {
//    echo "Server of the $url has no HTTP/2.0 support."; // nope!
    echo json_encode([
        'success' => false,
        'message' => "Server of the $url has no HTTP/2.0 support."
    ]);
} else {
//    echo "Server of the $url has no HTTP/2.0 support.";
    echo json_encode([
        'success' => false,
        'message' => "Server of the $url has no HTTP/2.0 support."
    ]);
//    echo curl_error($ch);
}
curl_close($ch);

die;




