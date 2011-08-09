<div id="fancyIMG">
	<p>Image Goes Here</p>
</div>
<div id="fancyInfo">
	<p><strong>Occurred On: </strong><?=$achievement->getDate()?></p>
	<p><strong>Location: </strong><?=$achievement->getLocation()?></p>
</div>
<div style="fancyDescrip">
	<h2>How it went</h2>
	<?=$achievement->getUserDescription()?>
</div>
<? 
	if($achievement->canEdit())
		echo "<p style='text-align:center;'><a href='#'>edit this achievement</a></p>";
?>