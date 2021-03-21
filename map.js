function initMap() {
    const myLatLng = {
      lat: 50.716667,
      lng: -3.533333
    };
    const myOtherLatLng = {
      lat: 50.716667,
      lng: -3.523333
    };
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: myLatLng,
    });
  
    new google.maps.Marker({
      position: myLatLng,
      map,
      title: "Hello World!",
    });
    new google.maps.Marker({
      position: myOtherLatLng,
      map,
      title: "Dikkat AT!",
    });
  }
  