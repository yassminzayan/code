<?php

$githubUsername = 'yassminzayan';
$githubRepo = 'Heem-Marketplace-v3-application';
$accessToken = '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';

// GitHub API URL for releases
$apiUrl = "https://api.github.com/repos/{$githubUsername}/{$githubRepo}/releases/latest";

// Set up cURL options
$options = [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Accept: application/vnd.github.v3+json',
        'Authorization: Bearer ' . $accessToken,
        'User-Agent: Awesome-App', // Replace with your app name or identifier
    ],
];

// Initialize cURL session
$ch = curl_init();
curl_setopt_array($ch, $options);

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Check if the request was successful
if (isset($data['tag_name'])) {
    $latestTag = $data['tag_name'];
    echo "Latest Release Tag: {$latestTag}";
} else {
    echo 'Unable to fetch release information.';
}
