<section id="foursquare">
	<h2><img width="40px" src="assets/icon_foursquare.png">Webdoos op Foursquare:</h2>
	<?php
		echo '<p>Aantal mensen momenteel ingecheckt via Foursquare: ' . $venueObject->response->venues[0]->hereNow->count . '</p>';
	    echo '<p>Totaal aantal check-ins: ' . $venueObject->response->venues[0]->stats->checkinsCount . '</p>';
	?>
</section>

