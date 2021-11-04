//Creating the map for the search results page
function initResultsMap(){
    //Map options
    var options = {
        zoom: 9,
        center: { lat: 43.5116, lng: -79.8929 }
      }
    // Create Map
    var map = new google.maps.Map(document.getElementById("result-location"), options);

    //Array of gyms. This will eventually be stored on the server
    var gyms = [
        { coords:{lat: 43.5116, lng: -79.8929 },
          popUPcontent: 
          '<h1 id="gym-name"><a href="./individual_sample.html">Impact Climbing</a></h1>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star-half"></i></span>'
        },
        { 
          coords:{lat: 43.7454, lng: -79.4744 },
          popUPcontent: 
          '<h1id="gym-name" class="nav-link not-active">True North Climbing</h1>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>'+
          '<span><i class="fas fa-star-half"></i></span>'
        }
      ]

    //Loop through gyms adding markers to the map
    gyms.forEach(entry => {
        addMarker(entry);
      });

    //Add Marker Function
    function addMarker(input){
        var marker = new google.maps.Marker({
          position: input.coords,
          map: map,
        });
        
        //make sure that gym content was given before creating a popup
        if(input.popUPcontent){
              var infoPopup = new google.maps.InfoWindow({
              content: input.popUPcontent
         });
         
        //open popup when marker is clicked 
        marker.addListener('click', function(){
          infoPopup.open(map,marker);
        });
        }
    }
}


//Creating the map for the Individual Gym page
function initGymMap(){
    //Map options
    var options = {
        zoom: 9,
        center: { lat: 43.5116, lng: -79.8929 }
      }
    // Create Map
    var map = new google.maps.Map(document.getElementById("gym-location"), options);

    //Array of gyms. This will eventually be stored on the server
    var gyms = [
        { coords:{lat: 43.5116, lng: -79.8929 },
          popUPcontent: 
          '<h1 id="gym-name"><a href="./individual_sample.html">Impact Climbing</a></h1>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star-half"></i></span>'
        },
        { 
          coords:{lat: 43.7454, lng: -79.4744 },
          popUPcontent: 
          '<h1id="gym-name" class="nav-link not-active">True North Climbing</h1>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>' +
          '<span><i class="fas fa-star"></i></span>'+
          '<span><i class="fas fa-star-half"></i></span>'
        }
      ]

    //Loop through gyms adding markers to the map
    addMarker(gyms[0]);
   

    //Add Marker Function
    function addMarker(input){
        var marker = new google.maps.Marker({
          position: input.coords,
          map: map,
        });
        
        //make sure that gym content was given before creating a popup
        if(input.popUPcontent){
              var infoPopup = new google.maps.InfoWindow({
              content: input.popUPcontent
        });
        
        //initially have the popup open
        infoPopup.open(map,marker);
        //open popup when marker is clicked after user closes it 
        marker.addListener('click', function(){
          infoPopup.open(map,marker);
        });
        }
    }
}