// A function that displays the search results to the browser
function displayResults(response) {
	console.log("in displayResults");

	// Convert the JSON formatted string into JS objects
	let JSresponse = JSON.parse(response);
	console.log(JSresponse);
	console.log(JSresponse.resultCount);
	console.log(JSresponse.results[0].trackName);


	// Clear out previous search results
	let tbody = document.querySelector("tbody");
	while( tbody.hasChildNodes() ) {
		tbody.removeChild(tbody.lastChild);
	}


	// Display the results
	for( let i = 0; i < JSresponse.results.length; i++) {
		// Create <tr> tag
		let trElement = document.createElement("tr");

		// Create <td> for the Cover art
		let coverTd = document.createElement("td");
		// Create an <img> tag for the cover art
		let imgElement = document.createElement("img");
		imgElement.src = JSresponse.results[i].artworkUrl100;
		// Append the <img> to the <td>
		coverTd.appendChild(imgElement);

		console.log(coverTd);

		// Create <td> for artist
		let artistTd = document.createElement("td");
		artistTd.innerHTML = JSresponse.results[i].artistName;

		// Create <td> for track
		let trackTd = document.createElement("td");
		trackTd.innerHTML = JSresponse.results[i].trackName;


		// Create <td> for album
		let albumTd = document.createElement("td");
		albumTd.innerHTML = JSresponse.results[i].collectionName;

		// Create <td> for preview
		let previewTd = document.createElement("td");
		// Create <audio> tag 
		let audioElement = document.createElement("audio");
		audioElement.src = JSresponse.results[i].previewUrl;
		audioElement.controls = true;
		// Append the <audio> to the <td> 
		previewTd.appendChild(audioElement);

		// Append all the <td> to <tr>
		trElement.appendChild(coverTd);
		trElement.appendChild(artistTd);
		trElement.appendChild(trackTd);
		trElement.appendChild(albumTd);
		trElement.appendChild(previewTd);

		// Append the newly created <tr> to <tbody>
		document.querySelector("tbody").appendChild(trElement);
	}
}




document.querySelector("#search-form").onsubmit = function(event) {

	// Prevent the form from actually submitting
	event.preventDefault();

	// Grab the search term that the user wants to search for
	let searchTerm = document.querySelector("#search-id").value.trim();

	// Grab the number of results user chose
	let limitInput = document.querySelector("#limit-id").value;

	console.log(searchTerm);
	console.log(limitInput);

	// Make a request to iTunes API with the user's search term and limit

	// To make an AJAX request with JavaScript, we will utilize the XMLHttpRequest object

	let url = "https://itunes.apple.com/search?term=" + searchTerm + "&limit=" + limitInput;

	let httpRequest = new XMLHttpRequest();
	// .open() - to start making a request
	// first param: Method
	// second param: the URL to make the request to
	httpRequest.open("GET", url);
	// Send the request. After it's sent, we have no idea when the iTunes will respond back. JS will not just wait here.
	httpRequest.send();
	// When iTunes DOES respond, the following event handler will be called. 
	httpRequest.onreadystatechange = function() {
		// This function will get called when iTunes eventually responds

		console.log(httpRequest.readyState);

		if(httpRequest.readyState == 4) {
			// We have a response from iTunes!
			if(httpRequest.status == 200) {
				// 200 means success. We have a success response.
				// .responseText will give us the response in String
				console.log(httpRequest.responseText);
				// Call the displayResults function to handle the display part. Pass the results to this function. 
				displayResults(httpRequest.responseText);
			}
			else {
				// There was an error from iTunes
				console.log(httpRequest.status);
			}
		}
	}

	console.log("hi!!!!!!");
	console.log("he");
	console.log("yi");
}

















