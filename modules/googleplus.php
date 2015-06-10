<section id="googleplus">
	<h2><img width="30px" src="assets/icon_googleplus.png">#webdoos op Google+:</h2>
	<table class="table table-striped">
		<thead>
			<tr></tr>
		</thead>
		<tbody>
				<?php
				if (!empty($objectGoogleplus)) {
					foreach($objectGoogleplus->items as $item) {
						$dt = DateTime::createFromFormat('Y M j H:i:s', $item->published);
						//2015-06-06T22:16:50.152Z
						echo $item->published;
						print ($dt);
						?>
						<tr>
							<td><img width="25px" src="assets/icon_googleplus.png"></td>
							<td><a href="<?= $item->actor->url . '">' . $item->actor->displayName . '</a> Posted <a href="' . $item->url . '">' . $item->title . '</a>'?></td>
							<td><?php /*echo $dt->format('d-m-Y H:i:s');*/?></td>
						</tr>
					<?php
					}
				}
					?>

			</tr>
		</tbody>
	</table>

</section>