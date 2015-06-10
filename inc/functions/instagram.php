<?php
function instagramGetPhotosByTag($tag) {
	global $client_id;
	//https://api.instagram.com/v1/tags/webdoos/media/recent?client_id=3d1a38ab4c89442e9356ddf82d7eb94c
	$url = 'https://api.instagram.com/v1/tags/' . $tag . '/media/recent?client_id=' . $client_id;
	$object = json_decode(file_get_contents($url));
	return $object;
}

function instagramGetPhotosByLocation($locationid) {
	global $client_id;
	https://api.instagram.com/v1/locations/11487578/media/recent?client_id=3d1a38ab4c89442e9356ddf82d7eb94c
	$url = 'https://api.instagram.com/v1/locations/' . $locationid . '/media/recent?client_id=' . $client_id;
	$object = json_decode(file_get_contents($url));
	return $object;
}

function renderInstagrams($instagrams,$yeah='') {
    echo '<h2><img width="30px" src="assets/icon_instagram.png"> Webdoos op Instagram:</h2>';
    // if (count($tweets) == 0) {
        // echo 'er zitten geen tweets in de db';
    // } else {

    
        echo '
        	<table class="table table-striped">
				<thead>
					<tr></tr>
				</thead>
				<tbody>
						<div class="medium-block-grid-2 large-block-grid-3">';
							// print_r($stringTwitter);
							foreach($instagrams as $items) {
								echo '
									<li>
										<div class="item">
											<div class="imageholder">
												<img src="' . $items->photo . '">
											</div>
											<div class="caption">
												<p class="tags">tags: ' . $items->tags;
												echo '</p>
												<p class="by"><img width="30px" src="' . $items->photo . '">' . $items->name . ' op ' . $items->date . ':</p>';
												echo '<p>' . $items->text . '</p>												
											</div>
										</div>
									</li>';
							}
							echo '
						</div>

					</tr>
				</tbody>
	</table>';
        if ($yeah != '') {
            echo $yeah;
        }
    // }
}
?>


