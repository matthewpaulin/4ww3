// validates the registration form
function validateRegistration() {
	const form = document.forms["registration"];
	const requiredFields = [
		"first-name",
		"last-name",
		"email",
		"password",
		"confirm-password",
	];

	//validate that the text fields are non-empty
	let hasEmptyField = false;
	for (const field of requiredFields) {
		if (form[field].value === "") {
			if (!form[field].parentNode.classList.contains("form-error"))
				form[field].parentNode.classList.add("form-error");
			hasEmptyField = true;
		}
	}
	//check if user consented to terms
	const consent = form["consent"].checked ? true : false;
	if (!consent && !form["consent"].parentNode.classList.contains("form-error"))
		form["consent"].parentNode.classList.add("form-error");

	// ensure passwords match
	const passwordsMatch =
		form["password"].value === form["confirm-password"].value;
	if (!passwordsMatch) {
		if (!form["password"].parentNode.classList.contains("form-error"))
			form["password"].parentNode.classList.add("form-error");
		if (!form["confirm-password"].parentNode.classList.contains("form-error"))
			form["confirm-password"].parentNode.classList.add("form-error");
	}

	// validate email address (the html also does a more basic check)
	let emailValid = validateEmail(form["email"].value);
	if (!emailValid && !form["email"].parentNode.classList.contains("form-error"))
		form["email"].parentNode.classList.add("form-error");

	// add error messages
	const errorMessages = [];
	if (hasEmptyField) errorMessages.push("Please complete all required fields");
	if (!consent) errorMessages.push("Please agree to the terms and conditions");
	if (!passwordsMatch) errorMessages.push("Passwords do not match");
	if (!emailValid) errorMessages.push("Please enter a valid email address");

	//Add dialog box with error messages
	if (errorMessages.length) {
		if (document.contains(document.getElementById("errors")))
			document.getElementById("errors").remove();
		form.insertAdjacentHTML("afterbegin", `<div id="errors"></div>`);
		errorMessages.forEach((err) => {
			document
				.getElementById("errors")
				.insertAdjacentHTML("beforeend", `<p>${err}</p>`);
		});
	}

	return consent && !hasEmptyField && passwordsMatch && emailValid;
}

// remove class that emphasizes form error
const removeErrorState = (element) =>
	element.parentNode.classList.remove("form-error");

//validate email with regex
const validateEmail = (email) => {
	const re =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return email === "" || re.test(String(email).toLowerCase());
};

//Creating the map for the search results page
function initResultsMap() {
	const urlparams = new URLSearchParams(window.location.search);
	const latitude = parseFloat(urlparams.get("lat")) || 43.5116;
	const longitude = parseFloat(urlparams.get("lng")) || -79.8929;
	//Map options
	var options = {
		zoom: 9,
		center: { lat: latitude, lng: longitude },
	};
	// Create Map
	var map = new google.maps.Map(
		document.getElementById("result-location"),
		options
	);

	//Array of gyms. This will eventually be stored on the server
	var gyms = [
		{
			coords: { lat: 43.5116, lng: -79.8929 },
			popUPcontent:
				'<h1 id="gym-name"><a href="./individual_sample.html">Impact Climbing</a></h1>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star-half"></i></span>',
		},
		{
			coords: { lat: 43.7454, lng: -79.4744 },
			popUPcontent:
				'<h1 id="gym-name">True North Climbing</h1>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star-half"></i></span>',
		},
	];

	//If the user want to search based on their location add a blue marker to show their location
	if (urlparams.get("lat")) {
		var marker = new google.maps.Marker({
			position: { lat: latitude, lng: longitude },
			map: map,
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
		});
		var infoPopup = new google.maps.InfoWindow({
			content: '<h1 id="gym-name">Your Location</h1>',
		});
		infoPopup.open(map, marker);
		marker.addListener("click", function () {
			infoPopup.open(map, marker);
		});
	}

	//Loop through gyms adding markers to the map
	gyms.forEach((entry) => {
		addMarker(entry);
	});

	//Add Marker Function
	function addMarker(input) {
		var marker = new google.maps.Marker({
			position: input.coords,
			map: map,
		});

		//make sure that gym content was given before creating a popup
		if (input.popUPcontent) {
			var infoPopup = new google.maps.InfoWindow({
				content: input.popUPcontent,
			});

			//open popup when marker is clicked
			marker.addListener("click", function () {
				infoPopup.open(map, marker);
			});
		}
	}
}

//Creating the map for the Individual Gym page
function initGymMap() {
	//Map options
	var options = {
		zoom: 9,
		center: { lat: 43.5116, lng: -79.8929 },
	};
	// Create Map
	var map = new google.maps.Map(
		document.getElementById("gym-location"),
		options
	);

	//Array of gyms. This will eventually be stored on the server
	var gyms = [
		{
			coords: { lat: 43.5116, lng: -79.8929 },
			popUPcontent:
				'<h1 id="gym-name"><a href="./individual_sample.html">Impact Climbing</a></h1>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star-half"></i></span>',
		},
		{
			coords: { lat: 43.7454, lng: -79.4744 },
			popUPcontent:
				'<h1 id="gym-name">True North Climbing</h1>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star"></i></span>' +
				'<span><i class="fas fa-star-half"></i></span>',
		},
	];

	//Only adding the marker for the gym in question
	addMarker(gyms[0]);

	//Add Marker Function
	function addMarker(input) {
		var marker = new google.maps.Marker({
			position: input.coords,
			map: map,
		});

		//make sure that gym content was given before creating a popup
		if (input.popUPcontent) {
			var infoPopup = new google.maps.InfoWindow({
				content: input.popUPcontent,
			});

			//initially have the popup open
			infoPopup.open(map, marker);
			//open popup when marker is clicked after user closes it
			marker.addListener("click", function () {
				infoPopup.open(map, marker);
			});
		}
	}
}

//Function to serach for gyms near the user
function gymsNearMe() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			(position) => {
				window.location.href = `./results_sample.html?lat=${position.coords.latitude}&lng=${position.coords.longitude}`;
			},
			(err) => alert("Please grant this site location access")
		);
	} else {
		console.error("geolocation api is unsupported");
	}
}

//Function to auto fill the Add new gym lattitude and longitude based on the users location
function useMyLocation() {
	const lat = document.getElementById("latitude");
	const long = document.getElementById("longitude");
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			(position) => {
				lat.value = position.coords.latitude;
				long.value = position.coords.longitude;
			},
			(err) => alert("Please grant this site location access")
		);
	} else {
		console.error("geolocation api is unsupported");
	}
}
