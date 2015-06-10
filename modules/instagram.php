<section id="instagram">
	<h2><img width="30px" src="assets/icon_instagram.png"> Webdoos op Instagram (locatie):</h2>
	<table class="table table-striped">
		<thead>
			<tr></tr>
		</thead>
		<tbody>
				<div class="medium-block-grid-2 large-block-grid-3">
				<?php
					// print_r($stringTwitter);
					foreach($objectLocationInstagram->data as $item) {
						?>
							<li>
								<div class="item">
									<div class="imageholder">
										<?php 
										echo '<img src="' . $item->images->low_resolution->url . '">';
										?>
									</div>
									<div class="caption">
										<?php
										echo '<p class="tags">tags: ';
										foreach($item->tags as $tag) {
											echo $tag . ' ';
										}
										echo '</p>';
										echo '<p class="by"><img width="30px" src="' . $item->caption->from->profile_picture . '">' . $item->caption->from->username . ' op ' . date('j M Y', $item->caption->created_time) . ':</p>';
										echo '<p>' . $item->caption->text . '</p>';
										?>
									</div>
								</div>
							</li>
					<?php
					}
					?>
				</div>

			</tr>
		</tbody>
	</table>
	<h2><img width="30px" src="assets/icon_instagram.png"> #webdoos op Instagram:</h2>	
	<table class="table table-striped">
		<thead>
			<tr></tr>
		</thead>
		<tbody>
				<div class="medium-block-grid-2 large-block-grid-3">
				<?php
					// print_r($stringTwitter);
					foreach($objectInstagram->data as $item) {
						?>
						
							<li>
								<div class="item">
									<div class="imageholder">
										<?php 
										echo '<img src="' . $item->images->low_resolution->url . '">';
										?>
									</div>
									<div class="caption">
										<?php
										echo '<p class="tags">tags: ';
										foreach($item->tags as $tag) {
											echo $tag . ' ';
										}
										echo '</p>';
										echo '<p class="by"><img width="30px" src="' . $item->caption->from->profile_picture . '">' . $item->caption->from->username . ' op ' . date('j M Y', $item->caption->created_time) . ':</p>';
										echo '<p>' . $item->caption->text . '</p>';
										?>
									</div>
								</div>
							</li>
					<?php
					}
					?>
				</div>

			</tr>
		</tbody>
	</table>
</section>

