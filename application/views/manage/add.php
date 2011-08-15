<script type="text/javascript">
	// Datepicker
	$(function() {
		$('.category').change(function() {
	        // path of ajax-loader gif image
	        var ajaxLoader = "<img src='<?=base_url()?>/img/site/ajax-loader.gif' alt='loading...' />";
	 
	        // get the selected option value of country
	        var achievementID = $(this).val();    
	        /**
	         * pass country value through GET method as query string
	         * the 'status' parameter is only a dummy parameter (just to show how multiple parameters can be passed)
	         * if we get response from data.php, then only the cityAjax div is displayed
	         * otherwise the cityAjax div remains hidden
	         */
	        jQuery("#achievementAjax")
	            .html(ajaxLoader)
	            .load('<?=base_url()?>ajax/achievement/'+achievementID, function(response){
	                if(response) {
	                    jQuery("#achievementAjax").css('display', '');
	                } else {
	                    jQuery("#achievementAjax").css('display', 'none');
	                }
	        });
		});
	});
</script>
<? if (validation_errors()): ?>
	<p style="font:color:red; font-size:16px;">	<?=validation_errors()?></p>
<? endif; ?>
<?=form_open_multipart('',array('id' => 'addAchievement', 'class' => 'uniForm'));?>
        
  <fieldset>
    <div class="ctrlHolder">
		<?=form_label('What kind of achievement was it?', 'category')?>
		<?=form_dropdown('category', $categories, set_value('category'),'class="required category"')?>
    </div>
    
    <div class="ctrlHolder" id="achievementAjax" style="display:none;">
    	<h1>Hidden </h1>
    </div>
    
    <div class="ctrlHolder">
		<?=form_label('Okay but how would you describe it best?', 'name')?>
		<?=form_input(array('name'=>'name','id'=>'name'), set_value('location'),'class="required"');?>
		<p class="formHint">(i.e. Pittsburgh Pirates, Penn State Graduation, Lift for Life)</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Where was it?', 'location')?>
		<?=form_input(array('name'=>'location','id'=>'location'), set_value('location'),'class="required"');?>
      	<p class="formHint">City, State</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('Pics or it didn\'t happen', 'userfile')?>
		<?=form_upload('userfile',  set_value('userfile'),'class="fileUpload"');?>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('When did this happen?', 'date_completed')?>
		<?=form_input(array('name'=>'date_completed','id'=>'datepicker','class'=>'required'), set_value('date_completed'))?>
      	<p class="formHint">2011-05-04 (Year, Month, Date)</p>
    </div>
    
    <div class="ctrlHolder">
    	<?=form_label('How was it?', 'description')?>
		<?=form_textarea(array('name'=>'description','id'=>'description'), set_value('description'),'class="required"')?>
    </div>
    
  </fieldset>
  
  <div class="buttonHolder">
    <button type="submit" class="primaryAction">Add your Achievement</button>
  </div>

</form>