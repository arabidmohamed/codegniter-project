var Utilities = Utilities || {};

Utilities.functions = function()
{
	
	var getBaseUrl = function() 
	{
	    // var burl = window.location.protocol+"//" + window.location.hostname + "/dwebsite";
		// return burl;
		var siteRoot = [
			window.location.protocol, 
			"//", 
			window.location.hostname
		].join("");

		var port = window.location.port;

		siteRoot = port !== "" ? siteRoot + ":" + port : siteRoot;

		siteRoot += "/" + window.location.pathname.split("/").splice(1,1);

		siteRoot = siteRoot.lastIndexOf("/") !== siteRoot.length - 1 ? siteRoot + "/" : siteRoot;

		return siteRoot;

	};

	var postToController = function (options) 
	{
		var settings = {
			url : options.url,
			formAction : options.formAction || "POST",   // e.g POST, DELETE, PUT
			data : options.postData, 					 // json object or array
			callback : options.callback 				 // callback function to be called after request completion
		};

        $.ajax({
            url: settings.url,
            type: settings.formAction,
            data: settings.data,
            success: function (response) {
                settings.callback(response);
            },
            error: function (err, exception) {
                console.log("Failed to post to server " + err.responseText);
            }
        });

    };

	var getFromAction = function (options) 
	{
		var settings = {
			url : options.url,
			params : options.params,
			callback : options.callback 				 // callback function to be called after request completion
		};

        $.get(settings.url, function (result) {
            settings.callback(result);

        }, function (err) {

            console.log(err.responseBody);
        });
	};
	
	var getQueryString = function (field, url) 
	{
		field = field.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + field + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
			
        if (!results) return null;
		if (!results[2]) return "";
		
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    };
	
	// convert text to title case
	var toTitleCase = function(str) 
	{
	    return str.replace(/(?:^|\s)\w/g, function(match) {
	        return match.toUpperCase();
	    });
	};

	// Image read function #live-preview
	var readURL = function(input) 
	{
	    if (input.files && input.files[0]) {
	        var file = input.files[0];
	        var fileType = file["type"];
	        var ValidImageTypes = ["application/pdf"];
	        if ($.inArray(fileType, ValidImageTypes) < 0) {
	            alert($('#ca_file_error').val());
	            $(input).val('');
	            return false;
	        }
	        var reader = new FileReader();
	        reader.onload = function(e) {
	
	        }; // end image onload
	
	    }; // end file reader
	
	    reader.readAsDataURL(input.files[0]);
	};

	//convert arabic numbers to english
	var arabictonum = function(str) 
	{
	    return str.replace(/[\u0660-\u0669]/g, function (c) {
	        return c.charCodeAt(0) - 0x0660;
	    }).replace(/[\u06f0-\u06f9]/g, function (c) {
	       return c.charCodeAt(0) - 0x06f0;
	   });
	};
	
	var dateRangeInit = function(options)
	{
		
		var settings = {
			format : options.format,
			fromInput : options.fromInput,
			toInput : options.toInput,
			calculateDuration: options.calculateDuration || false,
			durationInput : options.durationInput,
			durationArea : options.durationArea
		};
		
		var dateToday = new Date();
		var _dateFormat = settings.format,
	    from = $( settings.fromInput ).datepicker({
	          changeMonth: true,
	          changeYear: true,
	          numberOfMonths: 1,
	          minDate: dateToday,
	          dateFormat: _dateFormat
	          
	    }).on( "change", function() {
	         to.datepicker( "option", "minDate", getDate( this ) );
	         
	    }),
        to = $( settings.toInput ).datepicker({
	          changeMonth: true,
	          changeYear: true,
	          numberOfMonths: 1,
	          dateFormat: _dateFormat
	          
        }).on( "change", function() {
          from.datepicker( "option", "maxDate", getDate( this ) );
        });
        
        
        //get duration
        $(settings.fromInput).datepicker().bind("change", function () {
		    var minValue = $(this).val();
		    minValue = $.datepicker.parseDate(_dateFormat, minValue);
		    $(settings.toInput).datepicker("option", "minDate", minValue);
		    
		    if(settings.calculateDuration !== false)
		    {
			    calculateDuration();
		    }
		});
		$(settings.toInput).datepicker().bind("change", function () {
		    var maxValue = $(this).val();
		    maxValue = $.datepicker.parseDate(_dateFormat, maxValue);
		    $(settings.fromInput).datepicker("option", "maxDate", maxValue);
		    
		    if(settings.calculateDurations !== false)
		    {
			    calculateDurations();
		    }
		});
		
		function calculateDurations() 
		{
		    var d1 = $(settings.fromInput).datepicker('getDate');
		    var d2 = $(settings.toInput).datepicker('getDate');
		    var diff = 1;
		    if (d1 && d2) 
		    {
		        diff = diff + Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
		    }
		    $(settings.durationInput).val(diff);
		    $(settings.durationArea).text(diff);
		}

		function getDate( element ) {
	      var date;
	      try {
	        date = $.datepicker.parseDate( _dateFormat, element.value );
	      } catch( error ) {
	        date = null;
	      }
	 
	      return date;
		}
	};
	
	var initPlacePicker = function(_options)
	{
		var settings = {
			targetId : _options.targetId,
			restrictions : _options.restrictions || false, // e.g: { type: '[(cities)]', componentRestrictions: {country: "sa"} }
			componentForm : _options.componentForm || false, // e.g {  }
		};
		console.log(settings);
		var input = document.getElementById(settings.targetId);
		
		var options = {};
		if(settings.restrictions !== false)
		{
			options = settings.restrictions;
		}
		
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		
		autocomplete.addListener('place_changed', function() 
		{
			var place = autocomplete.getPlace();
			
			if(settings.componentForm !== false)
			{
				for (var i = 0; i < place.address_components.length; i++) 
		        {
			        var addressType = place.address_components[i].types[0];
			        if (settings.componentForm[addressType]) 
			        {
			           var val = place.address_components[i][settings.componentForm[addressType]];
			           document.getElementById(addressType).value = val;
			           console.log(addressType +' : ' +val);
			        }
			     }
		    }
		});
	};

	var select2Ajax = function (options) 
	{
		var settings = {
			currentElement : options.currentElement,
			controller     : options.controller,
			method		   : options.method 
		};

		var url = [getBaseUrl(), settings.controller, "/", settings.action].join("");
		
		$(settings.currentElement).select2({

            //minimumInputLength: 1,
            ajax: {
                dropdownAutoWidth: true,
                width: false,
                theme: "bootstrap",
                url: url,
                dataType: "json",
                type: "POST",
                data: function (item) {
                    return {
                        term: item.term||'a',
                        page: item.page || 1
                    };
                },
                processResults: function (data, params) {

                    params.page = params.page || 1;
                    var mappedData = $.map(data, function (obj) {
                        obj.text = obj.Name;
                        obj.id = obj.id;
                        return obj;
                    });
                    return {
                        results: mappedData,
                        pagination: {
                            more: (params.page * 30) < data.TotalCount
                        }
                    };
                }

            }
        });
    }
	
	var oPublic =
    {
      dateRangeInit 		: dateRangeInit,
      initPlacePicker 		: initPlacePicker,
      readURL				: readURL,
      arabictonum			: arabictonum,
      getBaseUrl			: getBaseUrl,
	  toTitleCase			: toTitleCase,
	  postToController		: postToController,
	  getFromAction			: getFromAction,
	  getQueryString		: getQueryString,
	  select2Ajax			: select2Ajax
    };
    
    return oPublic;
	
}();
