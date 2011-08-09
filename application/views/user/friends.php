<?php if ($friendsArray != NULL): ?>
	<?php foreach($friendsArray as $friend): ?>
		<div class="friendHolder">
				<img src="https://graph.facebook.com/<?=$friend->getUID()?>/picture" alt="<?=$friend->getName()?>" style='float:left; width:50px; height:50px;' />
				<div class="friendContent">
					<div class="friendText">
						<div style="font-size:1.2em;">
							<?=anchor("user/profile/{$friend->getID()}", $friend->getName(), array('title' => $friend->getName()));?>
						</div>
						<div style="font-size:.8em; padding-left:5px;">
						<strong> Recent Achievements: </strong>
							<? /* Recent Achievements */
								$recentArray = Userach_model::byUserID($friend->getID());
								
								if ($recentArray != NULL) {
									
									foreach($recentArray as $recent)
										echo $recent->getName() .", ";
								}
								else
									echo "No recent achievements";
							?>
						</div>
					</div>
					<div class="scoreSmall" style="float:right;"><?=$friend->getTotalPoints()?></div>
				</div>
		</div>
	<?php endforeach; ?>
<? else: ?>
<div style='text-align:center;'>
	<h2>You currently have no friends from facebook registered.</h2>
	<p><?=anchor('/','Share the love and tell all your friends!')?></p>
</div>
<? endif; ?>
</div>
<? if ($user->getTotalFriends() > 10): ?>
<div class="seeMore">
	<a href="#">See all <?=$user->getTotalFriends()?> friends</a>
</div>
<? endif; ?>