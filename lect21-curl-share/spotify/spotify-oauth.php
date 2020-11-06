<?php
    require("spotify-creds.php");

    // Checks for $_GET['code']
    if(!isset($_GET['code']) || empty($_GET['code'])) {
        echo "No code provided. Your redirect uri is printed below.";
        echo "<hr />";
        echo 'http://'. $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        exit(0);
    }

    $code = $_GET['code'];
    // echo "<pre>" . $code . "</pre>";

    // https://developer.spotify.com/documentation/general/guides/authorization-guide
    // POST request to https://accounts.spotify.com/api/token
    
    // 1. Create $data
    $data = array(
        "grant_type" => "authorization_code",
        "code" => $code,
        "redirect_uri" => $redirect_uri
    );

    // 2. Determine URL

    $full_url = "https://accounts.spotify.com/api/token";

    // 3. Make Request

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $full_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . base64_encode($client_id . ":" . $client_secret)
        )
    ));

    // 4. Parse Response

    $response = curl_exec($curl);
    $response = json_decode($response, true);

    // echo "<pre>";
    // print_r($response);
    // echo "</pre>";

    // 5. Filter Response (only get what you need)
    $_SESSION['access_token'] = $response['access_token'];
    $_SESSION['scope'] = $response['scope'];

    header("Location: index.php");