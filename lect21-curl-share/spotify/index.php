<?php
  require("spotify-creds.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
      integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
      crossorigin="anonymous"
    ></script>
    <title>ITP 303 - SpotifyGrid</title>
  </head>
  <body>
    <div id="main-container">
      <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand mx-auto" href="../index.html">ITP 303 - SpotifyGrid</a>
      </nav>
      <div class="container">
        <!-- Search Form -->
        <?php
          // https://developer.spotify.com/documentation/general/guides/authorization-guide
          // Search for "Authorization Code Flow"

          // Scopes = What permissions our app needs / refer to documentation
          // https://developer.spotify.com/documentation/general/guides/scopes/
          $scope = ["user-read-recently-played"];

          $authorize_url_params = array(
            "client_id" => $client_id,
            "response_type" => "code",
            "redirect_uri" => $redirect_uri,
            "scope" => implode(" ", $scope)
          );

          // IMPORTANT - Have to reauthorize if $copes is changed
          $authorize_url = "https://accounts.spotify.com/authorize?" . http_build_query($authorize_url_params);
        ?>
        <div class="text-center my-2">
          <a class="btn btn-success" href="<?php echo $authorize_url; ?>" role="button">Authorize with Spotify</a>
          <a class="btn btn-secondary" href="logout.php" role="button">Logout</a>  
        </div>
        <div class="text-center my-2">
          Requested Scope: [<code><?php echo implode("</code>, <code>", $scope); ?></code>]
        </div>
        <hr>
        <?php
        if(isset($_SESSION['access_token'])) {

          // If we have an access_token set

          ?>
          <div class="alert alert-success" role="alert">
            oAuth2.0 access token set!
            <hr>
            <p class="mb-0">Has Scope: [<code><?php echo str_replace(" ", "</code>, <code>", $_SESSION['scope']); ?></code>]</p>
          </div>
          <div class="row">
            <div class="col">
              <h1>Recently Played Songs</h1>
            </div>
          </div>
          <div id="spotify-grid" class="container card-columns my-2">
          <?php

          // Preparation --> Look for the appropriate scopes (have to reauthorize!)

          // https://developer.spotify.com/documentation/web-api/reference/player/get-recently-played/
          // https://developer.spotify.com/documentation/web-api/reference/personalization/get-users-top-artists-and-tracks/

          // 1. Create $data

          $data = array(
            "limit" => 12,
          );

          // 2. Determine URL
          // $full_url = "https://api.spotify.com/v1/me/top/tracks?" . http_build_query($data);
          $full_url = "https://api.spotify.com/v1/me/player/recently-played?". http_build_query($data);

          // 3. Make Request

          $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_URL => $full_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTPHEADER => array(
                  'Authorization: Bearer ' . $_SESSION['access_token']
              )
          ));

          // 4. Parse Response

          $response = curl_exec($curl);
          $response = json_decode($response, true);

          // echo "<pre>";
          // print_r($response);
          // echo "</pre>";

          // 5. Filter Response (only get what you need)
          // 6. Print Filtered Response
          foreach($response["items"] as $track) {
            $track = $track["track"];
            // echo "<pre>";
            // print_r($track);
            // echo "</pre>";
            
            ?>
            <div class="card">
                <img
                src="<?php echo $track["album"]["images"][0]["url"]; ?>"
                class="card-img-top"
                alt="<?php echo $track["name"]; ?>"
                />
                <div class="card-body">
                <h5 class="card-title"><?php echo $track["name"]; ?></h5>
                <p class="card-text">
                    <?php echo $track["artists"][0]["name"]; ?> - <span class="font-italic"><?php echo $track["album"]["name"]; ?></span>
                </p>
                </div>
            </div>
            <?php 
          }
          ?>
          </div>
          <?php
        } else {
          ?>
          <div class="row">
            <div class="col">
              <h1>Recently Played Songs</h1>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
  </body>
</html>
