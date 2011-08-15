<h1>List of Achievements</h1>
<?php if ($this->privileges >= 5) {
  echo anchor('achievement/create/', 'Add Achievement');  
}
?>
<?php foreach($achievementArray as $achievement): ?>
	<h2><?=$achievement->getName()?></h2>
	<div style="float:left; width:500px;"><?=$achievement->getDescription()?></div>
	<div style="float:right; width:150px;"><?=$achievement->getAvatarIMG('thumb','float:left; width:100px; height:100px;',$achievement->getName())?></div>
	<br class="clear">
	<p>Belongs to: <?=$achievement->getCategory()?></p>
	<p>Point Value: <?=$achievement->getPoint()?></p>
	<p><? echo anchor('achievement/update/'.$achievement->getID(), 'Update Achievement', array('title' => $achievement->getName()));?></p>
<?php endforeach; ?>