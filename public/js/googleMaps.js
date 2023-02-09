/** Initializes the map and the custom popup. */
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: { lat: 31.769758, lng: -106.505322 },
    mapTypeId: "satellite",
  });
}
window.initMap = initMap;

// labels in map
let popup, Popup;

window.onload = () => {
  var reader = new FileReader(),
    picker = document.getElementById("csvFile");
  picker.onchange = () => reader.readAsText(picker.files[0]);

  reader.onload = () => {
    // read cvs file and draw on map
    let csv = reader.result;
    csv = csv.split(/\r?\n/);
    for (let i = 1; i < csv.length - 5; i++) {
      let tokenFromFile = csv[i].split(",");

      // draw segment areas in map with coordinates and color value from file read
      segmentArea = {
        paths: [
          {
            lat: parseFloat(tokenFromFile[4]),
            lng: parseFloat(tokenFromFile[0]),
          },
          {
            lat: parseFloat(tokenFromFile[5]),
            lng: parseFloat(tokenFromFile[1]),
          },
          {
            lat: parseFloat(tokenFromFile[6]),
            lng: parseFloat(tokenFromFile[2]),
          },
          {
            lat: parseFloat(tokenFromFile[7]),
            lng: parseFloat(tokenFromFile[3]),
          },
        ],
        geodesic: true,
        strokeColor: tokenFromFile[9],
        strokeOpacity: 1.0,
        strokeWeight: 1,
        fillColor: tokenFromFile[9],
        fillOpacity: 0.6,
      };
      polygon = new google.maps.Polygon(segmentArea);
      polygon.setMap(map);

      /**
       * A customized popup on the map.
       */
      class Popup extends google.maps.OverlayView {
        position;
        containerDiv;
        mapLabel;
        constructor(position, value) {
          super();
          this.position = position;
          // create div for segment values
          const segmentValue = document.createElement("div");
          segmentValue.innerHTML = value;
          // add styling
          segmentValue.classList.add("popup-bubble");
          // store segment value in class in order to manipulate
          this.mapLabel = segmentValue;
          Popup.preventMapHitsAndGesturesFrom(this.mapLabel);
        }
        /** Called when the popup is added to the map. */
        onAdd() {
          this.getPanes().floatPane.appendChild(this.mapLabel);
        }
        /** Called when the popup is removed from the map. */
        onRemove() {
          if (this.mapLabel.parentElement) {
            this.mapLabel.parentElement.removeChild(this.mapLabel);
          }
        }
        /** Called each frame when the popup needs to draw itself. */
        draw() {
          const divPosition = this.getProjection().fromLatLngToDivPixel(
            this.position
          );
          // Hide the popup when it is far out of view.
          const display =
            Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000
              ? "block"
              : "none";

          if (display === "block") {
            this.mapLabel.style.left = divPosition.x + "px";
            this.mapLabel.style.top = divPosition.y + "px";
          }

          if (this.mapLabel.style.display !== display) {
            this.mapLabel.style.display = display;
          }
        }
      }

      // get segment coordinate and find center to place label
      var lngCenter =
        (parseFloat(tokenFromFile[2]) + parseFloat(tokenFromFile[0])) / 2;
      var latCenter =
        (parseFloat(tokenFromFile[6]) + parseFloat(tokenFromFile[4])) / 2;
      popup = new Popup(
        new google.maps.LatLng(latCenter, lngCenter),
        tokenFromFile[8]
      );
      popup.setMap(map);
    }

    // get legend info from file read
    var legendOptions = {};
    for (let i = csv.length - 4; i < csv.length; i++) {
      let legendToken = csv[i].split(",");
      if (i == csv.length - 4) {
        legendOptions["title"] = { name: legendToken[0] };
      } else {
        legendOptions["label" + (i - csv.length + 4)] = {
          name: legendToken[1],
          color: legendToken[0],
        };
      }
    }
    makeLegend(legendOptions);

    // re-center map to coordinates in file read
    reCenter = csv[1].split(",");
    var latlng = new google.maps.LatLng(
      parseFloat(reCenter[4]),
      parseFloat(reCenter[0])
    );
    map.setCenter(latlng);
    map.setMapTypeId("satellite");
  };
};

function makeLegend(legendOptions) {
  // construct legend for map with info from file read
  const legend = document.createElement("div");
  const legend_title = document.createElement("h6");

  legend.classList.add("legend");
  // legend title
  legend_title.innerHTML = legendOptions["title"]["name"];
  legend.appendChild(legend_title);

  for (const label in legendOptions) {
    if (label != "title") {
      // legend rows
      const row = document.createElement("div");
      row.style.paddingBottom = "5px";
      row.classList.add("row");

      // legend color square
      const col1 = document.createElement("div");
      col1.classList.add("col-1");
      const labelColor = document.createElement("div");
      labelColor.classList.add("col");
      labelColor.classList.add("square");
      labelColor.style.backgroundColor = legendOptions[label].color;

      // legend label
      const label_text = document.createElement("div");
      label_text.classList.add("legend_label");
      label_text.classList.add("col");
      label_text.innerHTML = legendOptions[label].name;

      // append elements
      row.appendChild(col1);
      row.appendChild(label_text);
      col1.appendChild(labelColor);
      legend.appendChild(row);
    }
  }
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
}
