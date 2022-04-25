
  // ---------------------- Google Maps API JS Script für menu.php --------------------- //
  function initMap() {
    // Map Option:
    let options = {
      zoom: 8, // Zoomangabe. Maximum ist 14
      center: {
        lat: 47.36667,
        lng: 8.55
      } // Zürich (Startpunkt)
    }
    // Map einbauen:
    let map = new google.maps.Map(document.getElementById('map'), options);

    // Array von Markierungen (Flexibilität steigern)
    let markers = [{
        // Marker 1
        koordinaten: {
          lat: 47.3852,
          lng: 8.4922
        },
        title: 'SAE Campus',
        content: '<h3>SAE Zürich</h3>',
        icon: {
          url: 'school-solid.svg',
          scaledSize: new google.maps.Size(38, 31)
        }
      },
      // Marker 2
      {
        koordinaten: {
          lat: 47.2852,
          lng: 8.3922
        },
        iconImage: ''
      },
      // Marker 3
      {
        koordinaten: {
          lat: 47.2852,
          lng: 8.6922
        },
        iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
      }

    ];
    // Durch die Markierungen Loopen:
    for (var i = 0; i < markers.length; i++) {
      addMarker(markers[i]);
    }

    // --x------------------- Google Maps API JS Script für menu.php ------------------x-- //
    // ---------------------- Google Maps GEO TAGGING API JS Script für menu.php --------------------- //
    // https://developers.google.com/maps/documentation/geocoding/start

    // Markierungsfunktion (um nicht für jeden Marker den Code jedes Mal zu kopieren)
    function addMarker(properties) {
      let marker = new google.maps.Marker({
        position: properties.koordinaten,
        map: map,
      });
      // A.1) Custom Icon prüfen:
      if (properties.iconImage) {
        // A.2) Custom-Icon einbauen falls gewünscht
        marker.setIcon(properties.iconImage);
      }
      // B.1) Inhalt für die Infobox prüfen:
      if (properties.content) {
        // B.2) Infobox zur Markierung einbauen falls gewünscht:
        let infoWindow = new google.maps.InfoWindow({
          content: properties.content
        });

        // (erfordert dazu Clickevent)
        marker.addListener('click', function() {
          infoWindow.open(map, marker)
        })
      }
    }

    
    
    async function geocode(e) { // Eventparameter e (Prevent Default, weil wir den Submit von ganz unten zuerst einfangen wollen)
      e.preventDefault();
      let location = document.getElementById('location-input').value; // 'In Strings kann einfach eine Adresse angebeben werden, doch dann wird nur diese ausgelesen'
      try {
        const response = await axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
          params: {
            address: location,
            key: 'AIzaSyAE7YtoM4U6NItd4v9a-eTinRliBnrli6Q'
          }
        });
        /* Positive Antwort */
        console.log(response); // Wir möchten das komplette Objekt als Antwort erhalten > In der Console unter Object > data > results


        // 1) Formatierte Adresse aus dem Datenobjekt herauslesen:
        let formattedAdress = response.data.results[0].formatted_address; //Objektreihenfolge und Namen müssen übereinstimmen wie in der Console angezeigt
        // ``= Template String, um auf mehreren Zeilen den String auszuführen / Mit ${} setzen wir eine Variable rein
        let formattedAdressOutput = ` 
        <ul class="list-group">
          <li class="list-group-item"><strong> ${formattedAdress}</strong></li> 
        <ul>
        `;

        // 2) Adress-Komponnten (Infobrocken, die bei der Suche passend dazu "aufploppen")
        let addressComponents = response.data.results[0].address_components; //Objektreihenfolge und Namen müssen übereinstimmen wie in der Console angezeigt
        let addressComponentsOutput = '<ul class="list-group">'; // Starttag
        for(let i = 0; i < addressComponents.length; i++){
          addressComponentsOutput += `
            <li class="list-group-item"><strong> ${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
          `;
        }
        addressComponentsOutput += '</ul>'; // Endtag

        // 3) Geometrie der Longitude und Latitude
        let latitude = response.data.results[0].geometry.location.lat; //Objektreihenfolge und Namen müssen übereinstimmen wie in der Console angezeigt
        let longitude = response.data.results[0].geometry.location.lng; //Objektreihenfolge und Namen müssen übereinstimmen wie in der Console angezeigt
        // ``= Template String, um auf mehreren Zeilen den String auszuführen / Mit ${} setzen wir eine Variable rein
        let geometryOutput = ` 
        <ul class="list-group">
          <li class="list-group-item"><strong>Latitude</strong>: ${latitude}</li> 
          <li class="list-group-item"><strong>Longitude</strong>: ${longitude}</li> 
        <ul>
        `;

        // 4) Output zur App (Startadresse / Komponenten dazu / Geometrie)
        document.getElementById('formatted-address').innerHTML = formattedAdressOutput;
        document.getElementById('address-components').innerHTML = addressComponentsOutput;
        document.getElementById('geometry').innerHTML = geometryOutput;






      } /* Negative Antwort */
      catch (error) {
        console.error(error);
      }
    }
    // Geocode Funktion aufrufen nicht vergessen!
    // Location Suchfeld aktivieren (Form)
    let locationForm = document.getElementById('location-form');
    // Submit aufrufen (über den Button "submit" - So lassen wir die geocode() laufen
    locationForm.addEventListener('submit', geocode);
    // geocode();
    // --x------------------- Google Maps GEO TAGGING API JS Script für menu.php ------------------x-- //
  }



  
