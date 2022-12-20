<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Intelligent Compaction</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Google API -->
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&libraries=drawing&callback=initMap"
        async
        defer
      ></script>

      <script src="{{ asset('../js/test.js') }}"></script>
    
      

      {{-- font awesome icons --}}
      {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> --}}
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            #map {
            height: 100%;
            /* width: 100%; */
            margin-left: 250px;
            }

            /* 
            * Optional: Makes the sample page fill the window. 
            */
            html,
            body {
            height: 95%;
            margin: 0;
            padding: 0;
            }
            /* The Modal (background) */
            .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 1; /* Sit on top */
              padding-top: 100px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 350px;
            }

            /* sidebar  */
            .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #efefef;
            overflow-x: hidden;
            transition: 0.1s;
            margin-top: 65px;
            padding-top: 65px;
            box-shadow: 5px 0 8px -3px #333
          }
        .sidenav a {
          padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 15px;
          /* color: #FFF; */
          display: block;
          transition: 0.3s;
          cursor: pointer;
        }

        .sidenav .closebtn {
          position: absolute;
          top: 0;
          right: 25px;
          font-size: 36px;
          margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }

        </style>
    </head>
    <body style="background-color: #003366">
      <div style="text-align: center; color: #FFF; position: relative; z-index:5">
        <h3>Intelligent Compaction Visualizer</h3>
      </div>
      
      <div id="mySidenav" class="sidenav" style="padding-left: 10px">
        {{-- <a id="modalButton"><i class="fa fa-map-o"></i> Graph</a> --}}
        {{-- <a id="modalButton"><i class="fa fa-map-o"></i> Graph</a> --}}
        <input type="file" id="csvFile" accept=".csv"  />
      </div>
      
        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> --}}

       

        <div id="map"></div>

    </body>
    <script>
        // This example creates a 2-pixel-wide red polyline showing the path of
        // the first trans-Pacific flight between Oakland, CA, and Brisbane,
        // Australia which was made by Charles Kingsford Smith.
        let map;
        function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
            zoom: 18,
            center: { lat: 31.769758,  lng: -106.505322 },
            mapTypeId: "satellite",
          });
        }
        window.initMap = initMap;
        window.onload = () => {
          var reader = new FileReader(),
              picker = document.getElementById("csvFile")
          picker.onchange = () => reader.readAsText(picker.files[0]);

          reader.onload = () => {
            // close modal 
            modal.style.display = "none";
            let csv = reader.result;

            csv = csv.split(/\r?\n/);

            // check if file has different format
            // if(csv[0] != "lat1,lat2,lat3,lat4,lng1,lng2,lng3,lng4,cmv,color"){
            //   alert('Unable to read file');
            //   return;
            // }

            for (let i = 1; i < csv.length-1; i++) {
              let element = csv[i].split(',');

              console.log(element);
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

              var latCenter = (parseFloat(element[0]) + parseFloat(element[2]))/2;
              var lngCenter = (parseFloat(element[4]) + parseFloat(element[6]))/2;
              // var cmvMarker = new google.maps.LatLng(parseFloat(element[0]), parseFloat(element[4]));
              var cmvMarker = new google.maps.LatLng(latCenter, lngCenter);
              var marker = new google.maps.Marker({
                    'position': cmvMarker,
                    'map': map,
                    'label': element[8],
                });
              marker.setMap(map);
            }
            reCenter = csv[1].split(',');
            // var latlng = new google.maps.LatLng(parseFloat(reCenter[0]), parseFloat(reCenter[4]));
            var latlng = new google.maps.LatLng(parseFloat(reCenter[4]), parseFloat(reCenter[0]));
            map.setCenter(latlng);
            map.setMapTypeId('satellite');
          }
        }
      </script>
      
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
