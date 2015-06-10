$(function() {
	function getTweets() {		
		jQuery.getJSON('inc/functions/gettweets.php', function(response) {
			console.log(response);
			$('#javascripttekst').html(response);
			// ojbect = jQuery.parseJSON(response)

			if(response.length > 0) {
				$("#twitter").load("ajax/index.php?select=getTweets");
				if(response[0].tweet) {
					$("#twitter").load("ajax/index.php?select=getTweets");
					// alert("tweet veld gezet!");
					
				} else {
					// alert ("nxi gezet!");
				}
				response.forEach(function (obj, index) {
					setTimeout(function () {
						showTweet(response[index]);
					}, index * 2000);
				});
			}	
		});
	}

	$(function () {
		$("button").click(function(){
        $("#twitter").load("ajax/index.php?select=getTweets");
    	});
		getTweets();
		setInterval(function () {
			getTweets();
		}, 180000);
	});

	function showTweet(oTweet) {
		$('#name').html(oTweet.name);
		$('#tweet').html(oTweet.tweet);
		$('#date').html(oTweet.date);
		$('#spotlight').show();
	}

/*
var hege = ["Cecilie", "Lone"];
var stale = ["Emil", "Tobias", "Linus"];
var children = hege.concat(stale);
//http://stackoverflow.com/questions/1129216/sort-array-of-objects-by-property-value-in-javascript


*/

// 		var set_delay = 15000,
//     	callout = function () {
// 	        $.ajax({
// 	            /* blah */
// 	        })
// 	        .done(function (response) {
// 	            // update the page
// 	        })
// 	        .always(function () {
// 	            setTimeout(callout, set_delay);
// 	        });
// 	    };

// // initial call
// callout();


	
$(document).foundation({
  equalizer : {
    // Specify if Equalizer should make elements equal height once they become stacked.
    equalize_on_stack: false
  }
});
});
