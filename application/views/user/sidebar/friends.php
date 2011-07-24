<p>
	<h1>Your Current Registered Friends</h1>
	<?php if ($friendsArray != NULL): ?>
		<?php foreach($friendsArray as $friend): ?>
			<?=anchor("user/profile/{$friend->getID()}", $friend->getName(), array('title' => $friend->getName()));?>
		<?php endforeach; ?>
	<? endif; ?>
</p>