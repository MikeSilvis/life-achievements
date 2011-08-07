<?php if ($achievementArray != NULL): ?>		
	<?php foreach($achievementArray as $achievement): ?>	
			<div class="friendHolder">
					<img src='<?=$achievement->getAvatarSmallURL()?>' style='float:left;' alt='<?=$achievement->getName()?>')>
					<div class="friendContent">
						<div class="friendText">
							<div style="font-size:1.2em;">
								<a href="<?=site_url("manage/view/".$achievement->getID());?>" class="ajax">
									<?=character_limiter($achievement->getName(), 15)?>
								</a>								
							</div>
							<div style="font-size:.8em; padding-left:5px;">
								<?=character_limiter($achievement->getDescription(), 100);?>
							</div>
						</div>
						<div class="scoreSmall" style="float:right;"><?=$achievement->getPoint()?></div>
					</div>
			</div>
	<? endforeach; ?>
<? else: ?>
	<div style='text-align:center;'>
		<h2>You currently have no achievements.</h2>
		<p><?=anchor('/','Add Some Now!')?></p>
	</div>
<? endif; ?>
</div>
<div class="seeMore">
<? $achievementCount = Userach_model::getTotalAchievements($user->getID())?>
<? if ($achievementCount > 10): ?>
	<a href="#">See all <?=$achievementCount?> Achievements</a>
<? endif; ?>