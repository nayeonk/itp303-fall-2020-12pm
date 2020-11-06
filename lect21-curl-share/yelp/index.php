<?php
    require("yelp-creds.php");
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
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"
    />
    <!-- Custom Scripts -->
    <script type="text/javascript" src="yelp.js"></script>
    <title>ITP 303 - YelpGrid</title>
  </head>
  <body>
    <div id="main-container">
      <nav class="navbar navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand mx-auto" href="../index.html">ITP 303 - YelpGrid</a>
        </div>
      </nav>
      <!-- Search Form -->
      <form id="search-form" class="form-inline container my-3">
        <div class="form-group mx-2">Looking for</div>
        <div class="form-group mx-2">
          <label for="search-term" class="sr-only">Term</label>
          <input
            id="search-term"
            type="text"
            class="form-control"
            placeholder="Korean Food"
          />
        </div>
        <div class="form-group mx-2">in</div>
        <div class="form-group mx-2">
          <label for="search-location" class="sr-only">Location</label>
          <input
            id="search-location"
            type="text"
            class="form-control"
            placeholder="Los Angeles"
          />
        </div>
        <button type="submit" class="btn btn-info mx-2">Search</button>
      </form>
      <!-- Yelp Grid -->
      <div id="yelp-grid" class="container card-columns my-2">
        <div class="card">
          <img src="https://s3-media2.fl.yelpcdn.com/bphoto/3RaGCRnE20HcJdlsHz6eWA/o.jpg"
            class="card-img-top"
            alt="Zinc Cafe &amp; Market"
          >
          <div class="card-body">
            <h5 class="card-title">Zinc Cafe & Market</h5>
            <p class="card-text">Breakfast & Brunch, Cocktail Bars, Vegetarian</p>
            <a
              href="https://www.yelp.com/biz/zinc-cafe-and-market-los-angeles-5"
              class="btn btn-danger"
              target="_blank"
            >
              <i class="fab fa-yelp"></i> Yelp
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
