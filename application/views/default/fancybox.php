<!DOCTYPE html>
<html>
<head>
<!-- jquery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!-- jQuery UI -->
<script type="text/javascript" src="<?=base_url()?>assets/jquery.ui/js/jquery-ui-1.8.15.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/jquery.ui/css/start/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
<!-- form Validation -->
<script type="text/javascript" src="<?=base_url()?>assets/form/js/uni-form-validation.jquery.js" charset="utf-8"></script>
<link href="<?=base_url()?>assets/form/css/uni-form.css" media="screen" rel="stylesheet"/>
<link href="<?=base_url()?>assets/form/css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>
<title><?=$title?></title>
<script type="text/javascript">
	// Datepicker
	$(function() {
		$('form.uniForm').uniform();		
		$( "#datepicker" ).datepicker();
	});
</script>
</head>
<body>
	<h1><?=$title?></h1>
	<div id="fancyBox">
		<?=$content?>
	</div>
</body>
</html>