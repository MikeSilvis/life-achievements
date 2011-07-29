<h1>List of Achievements</h1>
<?php foreach($achievementArray as $achievement): ?>
	<h2><?=$achievement->getName()?></h2>
	<p><?=$achievement->getDescription()?></p>
	<p>Belongs to: <?=$achievement->getCategory()?></p>
	<p><? echo anchor('achievement/update/'.$achievement->getID(), 'Update Achievement', array('title' => $achievement->getName()));?></p>
<?php endforeach; ?>