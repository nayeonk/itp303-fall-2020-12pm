<?php
    require("spotify-creds.php");

    unset($_SESSION['access_token']);
    unset($_SESSION['scope']);

    header("Location: index.php");