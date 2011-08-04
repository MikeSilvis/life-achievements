<div id="friends">
	<div class="contentTitle">
		<div class='title'>Friends</div>
		<div class="contentHolder">
			<?php if ($friendsArray != NULL): ?>
				<?php foreach($friendsArray as $friend): ?>
					<div class="friendHolder">
							<img src="https://graph.facebook.com/<?=$friend->getUID()?>/picture" alt="<?=$friend->getName()?>" style='float:left' />
							<div class="friendContent">
								<div class="friendText">
									<div style="font-size:1.2em;">
										<?=anchor("user/profile/{$friend->getID()}", $friend->getName(), array('title' => $friend->getName()));?>
									</div>
									<div style="font-size:.8em; padding-left:5px;">
										<strong>Recent Achievements: </strong> rabble, rabble, rabble
									</div>
								</div>
								<div class="scoreSmall" style="float:right;">23</div>
							</div>
					</div>
				<?php endforeach; ?>
			<? endif; ?>
		</div>
		<div class="seeMore">
			<a href="#">See all friends</a>
		</div>
	</div>
</div>