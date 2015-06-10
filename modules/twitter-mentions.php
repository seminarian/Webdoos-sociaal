<h2><img style="height:45px;" src="assets/icon_twitter.png">#webdoos op Twitter:</h2>
<table class="table table-striped">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
			<?php
			// print_r($stringTwitter);
			foreach($stringTwitter as $items) {
				$dt = DateTime::createFromFormat('D M j H:i:s P Y', $items['created_at']);
				?>
				<tr>
					<td><img width="35px" src="assets/icon_twitter.png"></td>
					<td><?=$items['user']['name'] . " Tweeted " . $items['text']?></td>
					<td><?php echo $dt->format('d-m-Y H:i:s');?></td>
				</tr>
			<?php
			}
			?>

		</tr>
	</tbody>
</table>
