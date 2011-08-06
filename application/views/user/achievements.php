<div id="achievements">
	<div class="contentTitle">
		<div class='title'>Achievements</div>
		<div class="contentHolder">
			<?php foreach($achievementArray as $achievement): ?>
				<?=$achievement->getName()?>
				<img src='<?=$achievement->getAvatarSmallURL()?>'>
			<? endforeach; ?>
		</div>
		<div class="seeMore">
			<a href="#">See all Achievements</a>
		</div>
	</div>
</div>