<?php

// Function to get the pipeline status (dummy data)
function getPipelineStatus() {
    // Replace this with logic to fetch pipeline status from CI/CD tool/API
    // For now, using random data
    $statuses = ['Success', 'Failure', 'Pending'];
    return $statuses[array_rand($statuses)];
}

// Function to get release information (dummy data)
function getReleases() {
    // Replace this with logic to fetch release information from Git or API
    // For now, using random data
    $releases = [];
    for ($i = 1; $i <= 3; $i++) {
        $releases[] = [
            'tag' => 'v1.' . $i . '.0',
            'description' => 'Release description ' . $i,
        ];
    }
    return $releases;
}
