<? if (validation_errors()): ?>
	<p style="font:color:red; font-size:16px;">	<?=validation_errors()?></p>
<? endif; ?>
<?=form_open('',array('id' => 'addAchievement', 'class' => 'uniForm'));?>
        
  <fieldset>
    <div class="ctrlHolder">
		<?=form_label('What did you do?', 'achievement')?>
		<?=form_dropdown('achievement', $achievementArray, set_value('category'))?>
    </div>
	
    <div class="ctrlHolder">
    	<?=form_label('Where was it?', 'location')?>
		<?=form_input(array('name'=>'location','id'=>'location'), set_value('location'));?>
      	<p class="formHint">City, State</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Pics or it didn\'t happen', 'name')?>
		<?=form_input(array('name'=>'badgePic','id'=>'badgePic'),  set_value('badgePic'));?>
    </div>
        
    <div class="ctrlHolder">
    	<?=form_label('When did you go?', 'date_completed')?>
		<?=form_input(array('name'=>'date_completed','id'=>'date_completed'), set_value('date_completed'))?>
      	<p class="formHint">05/04/2011</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('How was it?', 'description')?>
		<?=form_textarea(array('name'=>'description','id'=>'description'), set_value('description'))?>
    </div>
    
  </fieldset>
  
  <div class="buttonHolder">
    <button type="submit" class="primaryAction">Add your Achievement</button>
  </div>

</form>