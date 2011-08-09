<p style="font:color:red; font-size:16px;">	<? echo validation_errors(); echo $this->upload->display_errors(); ?></p>
<?=form_open_multipart(current_url(),array('id' => 'achievementUpdate', 'class' => 'uniForm'));?>
        
  <fieldset>
<? 
	if ($submissionType == "Insert")
		echo "<h3>Add a new Achievement</h3>";
	else if ($submissionType == "Update")
		echo "<h3>Update this Achievement</h3>";
?>
    
    <div class="ctrlHolder">
    	<?=form_label('Achievement Name', 'name')?>
		<?=form_input('name', set_value('name',$achievement->getName()));?>
      	<p class="formHint">Try to keep it short...</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Upload Avatar', 'name')?>
		<?=form_upload('userfile',  set_value('userfile',$achievement->getAvatar()));?>
    </div>

    <div class="ctrlHolder">
		<?=form_label('Category', 'category')?>
		<?=form_dropdown('category', $categoryArray, set_value('category',$achievement->getCategoryID()))?>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Point', 'point')?>
		<?=form_dropdown('point', array(1=>1,2=>2,3=>3,4=>4,5=>5), set_value('point',$achievement->getPoint()))?>
    </div>

    <div class="ctrlHolder">
    	<?=form_label('Description', 'description')?>
		<?=form_textarea('description', set_value('description',$achievement->getDescription()))?>
    </div>
    
  </fieldset>
  
  <div class="buttonHolder">
    <button type="submit" class="primaryAction"><?=$submissionType?> Achievement</button>
  </div>

</form>