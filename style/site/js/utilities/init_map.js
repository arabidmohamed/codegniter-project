var Map = Map || {};
var _autoCompleteInputDiv = "";
var _autoInput = "";
/**
 * This code is not fully dynamic and need some work at the bottom of code.
 */
    var markers = [];



function CenterControl(controlDiv, map) {
  // Set CSS for the control border.
  const controlUI = document.createElement("div");
  controlUI.style.backgroundColor = "#fff";
  controlUI.style.border = "2px solid #fff";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginBottom = "22px";
  controlUI.style.textAlign = "center";
  controlUI.title = "Click to recenter the map";
  controlDiv.appendChild(controlUI);
  // Set CSS for the control interior.
  const controlText = document.createElement("div");
  controlText.style.color = "rgb(25,25,25)";
  controlText.style.fontFamily = "Roboto,Arial,sans-serif";
  controlText.style.fontSize = "16px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.innerHTML = current_location;
  controlUI.appendChild(controlText);
  // Setup the click event listeners: simply set the map to Chicago.

}



Map.init = function(options)
{
	var settings = {
		mapID 				: options.mapID,
		zoom				: options.zoom || 8,
		autoCompleteInput	: options.autoCompleteInput,
		latitudeInput		: options.latitudeInput || 'latitude',
		longitudeInput		: options.longitudeInput || 'longitude',

		// latitude		    : options.latitude || 'longitude',
		// longitude		    : options.longitude || 'longitude',

		// addressId           : options.addressId,

		addressInput		: options.addressInput || 'frm_address',
		cityInput			: options.addressInput || 'locality',
		multiple			: options.multiple || false,
		baseUrl				: options.baseUrl || 'acp',
		country				: options.country || true,
		componentForm       : options.componentForm || false,
		restrictions 		: options.restrictions || false, // e.g: { type: '[(cities)]', componentRestrictions: {country: "sa"} }
		autoComplete		: typeof options.autoComplete == "undefined" ? true : options.autoComplete == false ? false : true,
		streetViewControl   : options.streetViewControl || true,
		mapTypeControl      : options.mapTypeControl || true,
		fullscreenControl   : options.fullscreenControl || true,
		currentLocation     : options.currentLocation || false,
		// reloadMap : options.reloadMap || true,
		// availableCities : options.availableCities,
	};

	var mp_markers = {};
	var myLatLng = '';
	var marker;

	 _autoInput = settings.autoCompleteInput;

	//initialize map
	var initAutocomplete = function()
	{

		var lat_l = document.getElementById(settings.latitudeInput).value;
		var lng_l = document.getElementById(settings.longitudeInput).value;

		myLatLng = {
			lat: parseFloat(lat_l == '' ? 24.7136 : lat_l),
			lng: parseFloat(lng_l == '' ? 46.6753 : lng_l)
		};

		//console.log(myLatLng);

		var initMapOptions = {
			center: myLatLng,
			zoom: settings.zoom,
			mapTypeId: 'roadmap',
			streetViewControl: false,
            mapTypeControl: false,
			fullscreenControl: false
		};

		var map = new google.maps.Map(document.getElementById(settings.mapID), initMapOptions);
			var geocoder = new google.maps.Geocoder();
		if(settings.autoComplete === true)
		{
		
			map.addListener('click', function(e) {
				placeMarker(e, map, geocoder);
			});

			//googleSearch(map);
		}

		// adding markers to google map from database
		if(lat_l.length > 0)
		{
			createMarkers(map);
		}

  const centerControlDiv = document.getElementById("current_location");

    centerControlDiv.addEventListener("click", () => {
    		    if (navigator.geolocation) {
				    navigator.geolocation.getCurrentPosition(function(position) {

	        var pos = {
				            lat: parseFloat(position.coords.latitude),
				            lng: parseFloat(position.coords.longitude)
				        };

				  placeMarker(position.coords, map, geocoder);
				  marker.setPosition(pos);
				  map.setCenter(pos);
                  map.setZoom(17); 


		    $('#'+settings.mapID).parent().find("input.latitude:hidden").val(position.coords.latitude);
			$('#'+settings.mapID).parent().find("input.longitude:hidden").val(position.coords.longitude);


			
		geocoder.geocode({ 'latLng': pos }, function (results, status) {
         if (status === google.maps.GeocoderStatus.OK) {
             //console.log(results);
			document.getElementById(settings.autoCompleteInput).value = results[0].formatted_address;
			document.getElementById(settings.addressInput).value = results[0].formatted_address;

           } 
         // else {
          //    // window.alert('No results found');
          // }


});

	

				    }, function() {
				        //handle location error (i.e. if user disallowed location access manually)
				    });
				} else {
				  // Browser doesn't support Geolocation
				}
  });


		searchBox = new google.maps.places.Autocomplete($('body').find('.map').find('#pac-input')[0],  settings.restrictions);
        searchBox.inputId = $('body').find('.map').find('#pac-input')[0].id;

//console.log(searchBox.inputId);

    searchBox.addListener('place_changed', function(e){
    	   var place = this.getPlace();


    	    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(14); // Why 17? Because it looks good.
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

			$('#'+this.inputId).parent().find("input.latitude:hidden").val(place.geometry.location.lat());
			$('#'+this.inputId).parent().find("input.longitude:hidden").val(place.geometry.location.lng());
			$('#'+this.inputId).parent().find("input.frm_address:hidden").val(place.formatted_address);
  
    });

		// if(settings.multiple === true)
		// {
		// 	google.maps.event.addListenerOnce(map, 'idle', function()
		// 	{
		// 		$("#"+settings.autoCompleteInput).after($('.add-location'));

		// 		setTimeout(function(){

		// 			$('body[dir="ltr"] .add-location').css({
		// 				'z-index': '1',
		// 				'position': 'absolute',
		// 				'top': '0px',
		// 				'left': (parseInt($("#"+settings.autoCompleteInput).width()) + 96) + "px"
		// 			});

		// 			$('body[dir="rtl"] .add-location').css({
		// 				'z-index': '1',
		// 				'position': 'absolute',
		// 				'top': '-7px',
		// 				'left': '110px'
		// 			});

		// 			$('.add-location').removeClass('hide');

		// 		}, 1000)

		// 	});
		// }
	};

	// click Event to put marker on User targeted area
	var placeMarker = function(e, map, geocoder)
	{
		var location = e.latLng;

	//	console.log(location);

		if (!marker || !marker.setPosition)
		{
			if(marker !== undefined)
			{
				marker.setVisible(false);
			}

			marker = new google.maps.Marker({
				position: location,
				draggable: true,
				map: map,
			});
			 markers.push(marker);
			//addMarkerDragListner(marker);

		} else {
			marker.setPosition(location);
		}


        var geocoder = new google.maps.Geocoder();
	   google.maps.event.addListener(marker, 'dragend', function(e)
	  {
	  	//updateInputs(location.lat(), location.lng());
	  	getLocationAddress(e.latLng, geocoder);
	  });

	  // update lat lng fields
	 // updateInputs(location.lat(), location.lng());

	  getLocationAddress(location, geocoder);

	
	};

	// get location address of the clicked area
	var getLocationAddress = function(location, geocoder)
	{

		let city =  [];
		let exist = [];
		geocoder.geocode({
			'latLng': location
		}, function(places, status) {
			if (status == google.maps.GeocoderStatus.OK)
			{
				if (places[0])
				{

				  console.log(places[0].formatted_address);
					document.getElementById(settings.autoCompleteInput).value = places[0].formatted_address;
					document.getElementById(settings.addressInput).value = places[0].formatted_address;

					$('.map').find("input.latitude:hidden").val(places[0].geometry.location.lat());
					$('.map').find("input.longitude:hidden").val(places[0].geometry.location.lng());




					if(settings.componentForm !== false)
					{
						modifyLocalityInputs(places[0], true);
					}
				}
			}
		});
	};

	// initialize map search autocomplete
	// var googleSearch = function(map)
	// {
	// 	var autoCompleteoptions = {};
	// 	if(settings.restrictions !== false)
	// 	{
	// 		autoCompleteoptions = settings.restrictions;
	// 	}

	// 	if(_autoInput.length == 0){
	// 		_autoInput = document.getElementById(settings.autoCompleteInput);
	// 	}

	// 	if(_autoCompleteInputDiv.length == 0){
	// 		//_autoCompleteInputDiv = document.getElementById('autocompleteControl');

	// 		_autoCompleteInputDiv = document.getElementsByClassName('search-map');

	// 	}

	// 	// var searchBox = new google.maps.places.Autocomplete(_autoInput, autoCompleteoptions);
	// 	// if(!options.currentLocation){
	// 	// 	_autoCompleteInputDiv = _autoInput;
	// 	// }

 // var autocompletes = [];
	// for (var i = 0; i < _autoCompleteInputDiv.length; i++) {

		

	// 	searchBox = new google.maps.places.Autocomplete(_autoCompleteInputDiv[i], autoCompleteoptions);
 //        searchBox.inputId = _autoCompleteInputDiv[i].id;



 //    searchBox.addListener('place_changed', function(e){
 //    	   var place = this.getPlace();




	// 		$('#'+this.inputId).parent().find("input.latitude:hidden").val(place.geometry.location.lat());
	// 		$('#'+this.inputId).parent().find("input.longitude:hidden").val(place.geometry.location.lng());
	// 		$('#'+this.inputId).parent().find("input.frm_address:hidden").val(place.formatted_address);
  
 //    });



 //      }
	// };

	// create marker for the search result
	var createMarkerForSearchResult = function(map, place, bounds)
	{
		if (!place.geometry) {
			console.log("Returned place contains no geometry");
			return;
		}
		var marker_srch = new google.maps.Marker({
			map: map,
			draggable: true,
			title: place.name,
			position: place.geometry.location
		});

		// google.maps.event.addListener(marker_srch, 'dragend', function() {

		// 	console.log(marker_srch);
		// 	updateInputs(this.position.lat(), this.position.lng());
		// });

		if (place.geometry.viewport) {
			bounds.union(place.geometry.viewport);
		} else {
			bounds.extend(place.geometry.location);
		}
	};

	// update target input
	// var updateInputs = function(lat, lng)
	// {
	// 	// document.getElementById(settings.latitudeInput).value = lat ;
	// 	// document.getElementById(settings.longitudeInput).value = lng;

	// 		$('.map').find("input.latitude:hidden").val(lat);
	// 		$('.map').find("input.longitude:hidden").val(lng);
	// };

	// update other inputs
	var modifyLocalityInputs = function(place, resetSublocalityField = false)
	{

		for (var i = 0; i < place.address_components.length; i++)
		{
			var addressType = place.address_components[i].types[0];
			if (settings.componentForm[addressType])
			{
				//console.log(addressType);
				var val = place.address_components[i][settings.componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
		}

		if(resetSublocalityField)
		{
			if(document.getElementById("sublocality_level_1"))
			{
				document.getElementById("sublocality_level_1").value = "";
			}
		} else {

			if(document.getElementById("political"))
			{
				document.getElementById("political").value = "";
			}

		}
	};

	// create markers for predefined lats, lngs
	var createMarkers = function(map)
	{
		if(settings.multiple === true)
		{

			var infoWindow = new google.maps.InfoWindow();
			var ll_mk = JSON.parse(document.getElementById("markers").value);

			for(var i = 0; i < ll_mk.length; i++)
			{
				var lat = parseFloat(ll_mk[i].lat);
				var lng = parseFloat(ll_mk[i].lng);

				var pos = new google.maps.LatLng(lat, lng);
				marker = new google.maps.Marker({
					position: pos,
					draggable: true,
					map: map,
				});
				var data = ll_mk[i];
				mp_markers[i] = marker;
				marker.id = i;
	            // add click event for google map markers
	            (function (marker, data) {
	            	google.maps.event.addListener(marker, "click", function (e) {
	                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.

	                    var content = data.Address;
	                    content += "<br /><input type = 'button' value = 'Delete' class='delete-marker' data-id='"+marker.id+"' data-lat ='"+data.lat+"' data-lng='"+data.lng+"' value = 'Delete' />";
	                    infoWindow.setContent(content);
	                    infoWindow.open(map, marker);
	                });
	            })(marker, data);

	          //  addMarkerDragListner(marker);
	        }

	    } else {

	    	marker = new google.maps.Marker({
	    		position: myLatLng,
	    		draggable: true,
	    		map: map,
	    	});
        var geocoder = new google.maps.Geocoder();
	   google.maps.event.addListener(marker, 'dragend', function(e)
	  {
	  	//updateInputs(location.lat(), location.lng());
	  	getLocationAddress(e.latLng, geocoder);
	  });

	    	if(settings.autoComplete === true)
	    	{
	    		//addMarkerDragListner(marker);
	    	}
	    }
	};

	// add drag event to marker
	// var addMarkerDragListner = function(marker)
	// {
	// 	google.maps.event.addListener(marker, 'dragend', function() {
	// 		updateInputs(this.position.lat(), this.position.lng());
	// 	});
	// };



	// load map on window load when the `init` method is initialized
	window.onload = initAutocomplete;

	var oPublic =
	{
		// initEvents : initEvents,
		initAutocomplete : initAutocomplete
	};

	return oPublic;

};