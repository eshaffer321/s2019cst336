<?php

/*
Here is what my command would look like on the command line
curl -X "GET" "https://api.spotify.com/v1/search?q=night%20moves&type=track&market=US" 
    -H "Accept: application/json" -H "Content-Type: application/json" 
    -H "Authorization: Bearer BQAJGLV9_-JE4XKCUYRW88TWVK9WSQJgvhnwLsdqewiOsiOpbtuI-sTjyqIFIxh76qX-Cf7nsiZ6OK24-JMOGAS6Rsw_-wb9uJ4B3GR5vojADKRuLLVXRycbsTTSSf6VyYadTi9FPwuOOm3LJxU"

*/

// Set the API key for my test account and apiKey expires so need to get a new one
$apiKey = "BQAJGLV9_-JE4XKCUYRW88TWVK9WSQJgvhnwLsdqewiOsiOpbtuI-sTjyqIFIxh76qX-Cf7nsiZ6OK24-JMOGAS6Rsw_-wb9uJ4B3GR5vojADKRuLLVXRycbsTTSSf6VyYadTi9FPwuOOm3LJxU";
$query = "night%20moves";
$type = "track";
$market = "US";
// Setup the CURL session
$cSession = curl_init();

// Setup the CURL options
curl_setopt($cSession,CURLOPT_URL, "https://api.spotify.com/v1/search?q=$query&type=$type&market=$market");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

// Add headers to the HTTP command
curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
));

// Execute the CURL command
$results = curl_exec($cSession);

// Check for specific non-zero error numbers
$errno = curl_errno($cSession);
if ($errno) {
    switch ($errno) {
        default:
            echo "Error #$errno...execution halted";
            break;
    }

    // Close the session and exit
    curl_close($cSession);
    exit();
}

// Close the session
curl_close($cSession);

// HintL: it is sometimes helpful to take echo the
// $results out and copy the array, then paste it into
// a beautifier online to see the data. For example, you
// could put the string JSON $results into the site
// https://codebeautify.org/jsonviewer

// Convert the results to an associative array
$musicData = json_decode($results);

echo $results;
// Let's just get one of the items and echo the JSON for that only.
//echo json_encode($musicData->tracks->items[0]);

?>