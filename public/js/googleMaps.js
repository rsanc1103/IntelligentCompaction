// This example creates a 2-pixel-wide red polyline showing the path of
// the first trans-Pacific flight between Oakland, CA, and Brisbane,
// Australia which was made by Charles Kingsford Smith.
let map;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: { lat: 31.769758, lng: -106.505322 },
    mapTypeId: "satellite",
  });
}
window.initMap = initMap;
window.onload = () => {
  var reader = new FileReader(),
    picker = document.getElementById("csvFile");
  picker.onchange = () => reader.readAsText(picker.files[0]);

  reader.onload = () => {
    let csv = reader.result;

    csv = csv.split(/\r?\n/);

    // check if file has different format
    // if(csv[0] != "lat1,lat2,lat3,lat4,lng1,lng2,lng3,lng4,cmv,color"){
    //   alert('Unable to read file');
    //   return;
    // }

    for (let i = 1; i < csv.length - 1; i++) {
      let element = csv[i].split(",");

      flightPath = {
        paths: [
          { lat: parseFloat(element[4]), lng: parseFloat(element[0]) },
          { lat: parseFloat(element[5]), lng: parseFloat(element[1]) },
          { lat: parseFloat(element[6]), lng: parseFloat(element[2]) },
          { lat: parseFloat(element[7]), lng: parseFloat(element[3]) },
        ],
        // paths: [
        //   { lat: parseFloat(element[0]), lng: parseFloat(element[4]) },
        //   { lat: parseFloat(element[1]), lng: parseFloat(element[5]) },
        //   { lat: parseFloat(element[2]), lng: parseFloat(element[6]) },
        //   { lat: parseFloat(element[3]), lng: parseFloat(element[7]) },
        // ],
        geodesic: true,
        strokeColor: element[9],
        strokeOpacity: 1.0,
        strokeWeight: 1,
        fillColor: element[9],
        fillOpacity: 0.6,
      };
      polygon = new google.maps.Polygon(flightPath);
      polygon.setMap(map);

      var latCenter = (parseFloat(element[0]) + parseFloat(element[2])) / 2;
      var lngCenter = (parseFloat(element[4]) + parseFloat(element[6])) / 2;
      // var cmvMarker = new google.maps.LatLng(parseFloat(element[0]), parseFloat(element[4]));
      var cmvMarker = new google.maps.LatLng(latCenter, lngCenter);
      var marker = new google.maps.Marker({
        position: cmvMarker,
        map: map,
        label: element[8],
      });
      marker.setMap(map);
    }
    reCenter = csv[1].split(",");
    // var latlng = new google.maps.LatLng(parseFloat(reCenter[0]), parseFloat(reCenter[4]));
    var latlng = new google.maps.LatLng(
      parseFloat(reCenter[4]),
      parseFloat(reCenter[0])
    );
    map.setCenter(latlng);
    map.setMapTypeId("satellite");
  };
};
