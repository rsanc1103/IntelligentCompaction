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

    for (let i = 1; i < csv.length - 5; i++) {
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

      var showLabels = document.getElementById("showLabels");
      if (showLabels.checked == true) {
        var lngCenter = (parseFloat(element[2]) + parseFloat(element[0])) / 2;
        var latCenter = (parseFloat(element[6]) + parseFloat(element[4])) / 2;
        // var latCenter = (parseFloat(element[0]) + parseFloat(element[2])) / 2;
        // var lngCenter = (parseFloat(element[4]) + parseFloat(element[6])) / 2;
        // var cmvMarker = new google.maps.LatLng(parseFloat(element[0]), parseFloat(element[4]));
        var cmvMarker = new google.maps.LatLng(latCenter, lngCenter);
        var marker = new google.maps.Marker({
          position: cmvMarker,
          map: map,
          label: element[8],
        });
        marker.setMap(map);
      }
    }
    var legendOptions = {};
    for (let i = csv.length - 4; i < csv.length; i++) {
      let element = csv[i].split(",");
      if (i == csv.length - 4) {
        legendOptions["title"] = { name: element[0] };
      } else {
        legendOptions[element[1]] = { name: element[1], color: element[0] };
      }
    }
    const legend = document.getElementById("legend");
    legend.innerHTML = "";
    const title = document.createElement("div");
    title.innerHTML =
      "<div><h3>" + legendOptions["title"]["name"] + "</h3></div>";
    legend.appendChild(title);
    //console.log(legendOptions);
    for (const key in legendOptions) {
      if (key != "title") {
        const type = legendOptions[key];
        const name = type.name;
        const color = type.color;
        const div = document.createElement("div");

        div.innerHTML =
          '<br></br><div class="row"><div class="col-1"><div id="square" style="background-color:' +
          color +
          ';"></div></div><div class="col">' +
          name +
          "</div></div>";
        legend.appendChild(div);
      }
    }
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);

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
