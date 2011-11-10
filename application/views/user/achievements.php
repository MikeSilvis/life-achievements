<?php if ($achievementArray != NULL): ?>		
	<?php foreach($achievementArray as $achievement): ?>	
			<div class="friendHolder">
					<?=$achievement->getAvatarIMG('thumb','float:left; width:50px; height:50px;',$achievement->getName())?>
					<div class="achievementContent">
						<div class="achievementText">
							<div style="font-size:1.2em;">
								<a href="<?=site_url("manage/view/".$achievement->getUserAchID());?>" class="ajax">
									<?=character_limiter($achievement->getUserName(), 50)?>
								</a>								
							</div>
							<div style="font-size:.8em; padding-left:5px;">
								<?=character_limiter($achievement->getUserDescription(), 150);?>
								<? 
									if($achievement->canEdit())
										echo anchor('/manage/update/'.$achievement->getUserAchID(),'edit','class="ajax"');
								?>
							</div>
						</div>
						<div class="scoreSmall" style="float:right;"><?=$achievement->getPoint()?></div>
					</div>
			</div>
	<? endforeach; ?>
	<? if($achievement->canEdit()): ?>
		<div style="text-align:center;">
			<h2><a href="<?=site_url('/manage/add')?>" class='ajax'>Add Achievement</a></h2>
		</div>
	<? endif; ?>

<? else: ?>
	<div style='text-align:center;'>
		<h2><?=$user->getName()?> currently has no achievements.</h2>
	</div>
<? endif; ?>

</div>
<div class="seeMore">
<? $achievementCount = Userach_model::getTotalAchievements($user->getID())?>
<? if ($achievementCount > 10): ?>
	<a href="#">See all <?=$achievementCount?> Achievements</a>
<? endif; ?>
