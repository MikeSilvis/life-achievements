<? if (validation_errors()): ?>
	<p style="font:color:red; font-size:16px;">	<?=validation_errors()?></p>
<? endif; ?>
<?=form_open_multipart('',array('id' => 'addAchievement', 'class' => 'uniForm'));?>
        
  <fieldset>
    <div class="ctrlHolder">
		<strong>Achievement Otained:</strong><?=$achievement->getName()?>
		<br>
		<?=$achievement->getUserAvatarIMG('thumb')?>
    </div>

    <div class="ctrlHolder">
		<?=form_label('Okay but how would you describe it best?', 'name')?>
		<?=form_input(array('name'=>'name','id'=>'name'), set_value('location',$achievement->getUserName()),'class="required"');?>
		<p class="formHint">(i.e. Pittsbrugh Pirates, Penn State Graduation, Lift for Life)</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Where was it?', 'location')?>
		<?=form_input(array('name'=>'location','id'=>'location'), set_value('location',$achievement->getLocation()),'class="required"');?>
      	<p class="formHint">City, State</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Pics or it didn\'t happen', 'userfile')?>
		<?=form_upload('userfile',  set_value('userfile'));?>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('When did this happen?', 'date_completed')?>
		<?=form_input(array('name'=>'date_completed','id'=>'date_completed'), set_value('date_completed',$achievement->getDate(),'class="required"'))?>
      	<p class="formHint">2011-05-04 (Year, Month, Date)</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('How was it?', 'description')?>
		<?=form_textarea(array('name'=>'description','id'=>'description'), set_value('description',$achievement->getUserDescription()),'class="required"')?>
    </div>
    
  </fieldset>
  
  <div class="buttonHolder">
    <button type="submit" class="primaryAction">Update your Achievement</button>
  </div>

</form>