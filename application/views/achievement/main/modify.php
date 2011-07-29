<p>
	<? 
		if ($submissionType == "Insert")
			echo "Please add a new Achievement to our database";
		else if ($submissionType == "Update")
			echo "Please update this Achievement in our database";
	?>
</p>
<p style="font:color:red; font-size:16px;">	<?=validation_errors()?></p>
<p>
	<?=form_open('achievement/update/'.$achievement->getID(),array('id' => 'achievementUpdate'),array('achievement_id' => $achievement->getID()));?>
	  	<?=form_fieldset($submissionType ." ".set_value('name',$achievement->getName()))?>
		<?=form_label('Achievement Name', 'name')?>
		<?=form_input('name', set_value('name',$achievement->getName()));?>
	<br>
		<?=form_label('URL of the Badge(to be updated with file upload form)', 'badgePic');?><?=form_input('badgePic',  set_value('badgePic',$achievement->getAvatar()));?>
	<br>
		<?=form_label('Category', 'category')?>
		<?=form_dropdown('category', $categoryArray, set_value('category',$achievement->getCategoryID()))?>
		<?=form_textarea('description', set_value('description',$achievement->getDescription()))?>
		<?=form_submit('submit', $submissionType .' Achievement')?>
		<?=form_fieldset_close()?>
	</form>
</p>