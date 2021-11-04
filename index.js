function initMap(){
    //Map options
    var options = {
        zoom: 9,
        center: { lat: 43.5116, lng: -79.8929 }
      }
    // Create Map
    var map = new google.maps.Map(document.getElementById("result-location"), options);

    //Array of gyms. This will eventually be stored on the server
    var markers = [
        { 
          coords:{lat: 43.5116, lng: -79.8929 },
          popUPcontent: '<h1>Impact Climbing</h1>'
        },
        { 
          coords:{lat: 43.7454, lng: -79.4744 },
          popUPcontent: 
            '<h1 id=popup>True North Climbing</h1>' +
            '<h1 >3 Stars</h1>'
        }
      ]

    //Loop through gyms adding markers to the map
    markers.forEach(entry => {
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