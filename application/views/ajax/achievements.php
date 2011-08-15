<?=form_label('What did you do?', 'achievement')?>
<? // add a blank element to the array 
	$achievements["0"] = "";
	ksort($achievements);
?>
<?=form_dropdown('achievement', $achievements, set_value('achievement'),'class="required"')?>