<h2><img style="height:45px;" src="assets/icon_twitter.png">Webdoos on twitter:</h2>
<table class="table table-striped">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
			<?php
			// print_r($eigenTweets);
			foreach($tweets as $tweet) {
				//Sat Jun 06 14:34:01 +0000 2015
				?>
				<tr>
					<td><img width="35px" src="assets/icon_twitter.png"></td>
					<td><?=$tweet->name . " Tweeted " . $tweet->tweet?></td>
					<td><?php echo $tweet->date;?></td>
				</tr>
			<?php
			}
			?>

		</tr>
	</tbody>
</table>