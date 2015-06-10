<?php
function googleZoekPublicPosts($key,$zoekString) {
	$activities_search = "https://www.googleapis.com/plus/v1/activities?query=" . $zoekString . "&key=" . $key;
	// $object = curl("GET",$activities_search);
	$object = json_decode(file_get_contents($activities_search));
	return $object;
}

function googleZoekPersoon($key,$zoekstring) {
	$persoon_search = "https://www.googleapis.com/plus/v1/people?query=" . $zoekstring . "&key=" . $key;
	// $object = curl("GET",$persoon_search);
	$object = json_decode(file_get_contents($persoon_search));
	return $object;
}

function googleGetPublicPosts($key,$id) {
	$url = "https://www.googleapis.com/plus/v1/people/" . $id . "/activities/public" . "?key=" . $key;
	print($url);
	// $object = curl("GET",$url);
	$object = json_decode(file_get_contents($url));
	return $object;
}

function renderGooglePluses($googlePluses,$yeah='') {
	echo '<h2><img width="30px" src="assets/icon_googleplus.png">#webdoos op Google+:</h2>
	<table class="table table-striped">
		<thead>
			<tr></tr>
		</thead>
		<tbody>';
				if (!empty($googlePluses)) {
					foreach($googlePluses->items as $item) {
						// $dt = DateTime::createFromFormat('Y M j H:i:s', $item->published);
						//2015-06-06T22:16:50.152Z
						// echo $item->published;
						// print ($dt);
						echo '
						<tr>
							<td><img width="25px" src="assets/icon_googleplus.png"></td>
							<td><a href="' . $item->userLink . '">' . $item->name . '</a> Posted <a href="' . $item->postLink . '">' . $item->message . '</a></td>
							<td>' . $item->date . '</td>
						</tr>';
					}
				}
			echo '
			</tr>
		</tbody>
	</table>';
        if ($yeah != '') {
            echo $yeah;
        }
    // }
}
?>



