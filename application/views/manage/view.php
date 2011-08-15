<div id="fancyIMG">
	<p><?=$achievement->getUserAvatarIMG('large','width:150px;',$achievement->getName());?></p>
</div>
<div id="fancyInfo">
	<p><strong>Achievement: </strong><?=$achievement->getName()?></p>
	<p><strong>Category: </strong><?=$achievement->getCategory()?></p>
	<p><strong>Occurred On: </strong><?=$achievement->getDate()?></p>
	<p><strong>Location: </strong><?=$achievement->getLocation()?></p>
</div>
<div id="fancyDescrip">
	<h2>How it went</h2>
	<?=$achievement->getUserDescription()?>
</div>
<div id='fancyAvatar'>
	<?=$achievement->getAvatarIMG('thumb','',$achievement->getName())?>
</div>
<? /*
	if($achievement->canEdit())
		echo "<br class='clear'><div><p><a href='' id='edit'>Edit this achievement</a></p></div>";
*/ ?>