$(document).ready(function () {
  // Executes once the page has completely loaded

  // Note: By convention, document elements selected with jQuery have variables that start with $

  // Form Related
  const $searchForm = $("#search-form");
  const $searchTerm = $("#search-term");
  const $searchLocation = $("#search-location");

  // Yelp Grid (results load here)
  const $yelpGrid = $("#yelp-grid");

  // Load From Yelp Function
  function loadFromYelp(searchTerm, searchLocation) {
    $.ajax({
      method: "GET",
      url: "yelp-backend.php",
      data: { searchTerm: searchTerm, searchLocation: searchLocation },
    }).done(function (response) {
      // Clears $yelpGrid
      $yelpGrid.html("");

      for (let business of response) {
        const businessHTML = `
          <div class="card">
            <img
              src="${business.image_url}"
              class="card-img-top"
              alt="${business.name}"
            />
            <div class="card-body">
              <h5 class="card-title">${business.name}</h5>
              <p class="card-text">${business.categories}</p>
              <a
                href="${business.url}"
                class="btn btn-danger"
                target="_blank"
                >
                <i class="fab fa-yelp"></i> Yelp
                </a
              >
            </div>
          </div>`;

        // Append business to $yelpGrid
        $yelpGrid.append(businessHTML);
      }
    });
  }

  // Form Handler
  $searchForm.on("submit", function (e) {
    e.preventDefault();

    // Get input values
    const searchTerm = $searchTerm.val();
    const searchLocation = $searchLocation.val();

    // console.log(searchTerm);
    // console.log(searchLocation);

    loadFromYelp(searchTerm, searchLocation);
  });

  // On page load
  loadFromYelp("Korean Food", "Los Angeles");
});
