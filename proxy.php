<?php
if (isset($_GET['segment'])) {
    // Decode the segment URL from Base64
    $decodedSegment = base64_decode($_GET['segment']);
    
    // Validate the URL
    if (filter_var($decodedSegment, FILTER_VALIDATE_URL)) {
        // Set headers for streaming
        header("Content-Type: application/vnd.apple.mpegurl");
        header("Access-Control-Allow-Origin: *");
        
        // Fetch and serve the content
        $content = @file_get_contents($decodedSegment);
        if ($content === false) {
            http_response_code(404);
            echo "Failed to fetch the stream.";
        } else {
            echo $content;
        }
    } else {
        http_response_code(400);
        echo "Invalid URL provided.";
    }
} elseif (isset($_GET['index'])) {
    // Directly handle the `.m3u8` file
    $indexUrl = $_GET['index'];
    
    if (filter_var($indexUrl, FILTER_VALIDATE_URL)) {
        header("Content-Type: application/vnd.apple.mpegurl");
        header("Access-Control-Allow-Origin: *");
        
        $content = @file_get_contents($indexUrl);
        if ($content === false) {
            http_response_code(404);
            echo "Failed to fetch the stream.";
        } else {
            echo $content;
        }
    } else {
        http_response_code(400);
        echo "Invalid URL provided.";
    }
} else {
    http_response_code(400);
    echo "No valid parameters provided.";
}
?>
