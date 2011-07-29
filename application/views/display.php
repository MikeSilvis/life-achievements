<h1>List of Achievements</h1>
<?php foreach($achievementArray as $achievement): ?>
	<h2><?=$achievement->getTitle()?></h2>
	<p><?=$achievement->getDescription()?></p>
	<p><? echo anchor('achievement/update/'.$achievement->getID(), 'Update Achievement', array('title' => $achievement->getTitle()));?></p>
<?php endforeach; ?>