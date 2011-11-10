<!DOCTYPE html>
<html>
<head>
<title><?=$title;?></title>
<link rel="stylesheet" href='<?=base_url()?>assets/css/style.css' type="text/css" media="screen, projection" />
<!-- jquery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!-- jQuery UI -->
<script type="text/javascript" src="<?=base_url()?>assets/jquery.ui/js/jquery-ui-1.8.15.custom.min.js"></script>
<link type="text/css" href="<?=base_url()?>assets/jquery.ui/css/start/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
<!-- fancybox -->
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/js/plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<!-- form Validation -->
<script type="text/javascript" src="<?=base_url()?>assets/form/js/uni-form-validation.jquery.js" charset="utf-8"></script>
<link href="<?=base_url()?>assets/form/css/uni-form.css" media="screen" rel="stylesheet"/>
<link href="<?=base_url()?>assets/form/css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>	
<!-- Facebook API -->
<meta property="fb:app_id" content="229353873772038">
<?=$_scripts?>
<?=$_styles?>
<script type="text/javascript">
	$(document).ready(function() {
			$(".ajax").fancybox();
			$( "#datepicker" ).datepicker();
	});
	$("#addAchievement").bind("submit", function() {
		$.fancybox.showActivity();
	
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: "life/manage/add.php",
			data	: $(this).serializeArray(),
			success: function(data) {
				$.fancybox(data);
			}
		});
	
		return false;
	});
	$(function(){
		$('form.uniForm').uniform();
		$( "#datepicker" ).datepicker();
	});	
</script>
</head>
<body>
<? /* <img class="bg" alt="" src="<?=base_url()?>assets/img/site/bg.jpg"> */ ?>
<div id="wrapper">
	<div id="header">
		<div id="logo"></div>
		<div id="search">
			<form>
				<input type="text" id="searchBox" placeholder="Search">
			</form>
		</div>
		<div id="userInfo">
			<?
				if ($this->session->userdata('user_id')) {   		
					echo anchor('user/profile/'.$this->session->userdata('user_id'), $this->session->userdata('name'));
					echo " | ". anchor('authenticate/logout','Log out');
				}
				else 	
				    echo anchor('/authenticate/login','<fb:login-button>login</fb:login-button>');
			?>			
		</div>
	</div>
	<?
		if ($this->session->flashdata('success') != NULL)
			echo "<div class='contentHolder' id='success'>".$this->session->flashdata('success')."</div>";
		else if( $this->session->flashdata('error') != NULL)
			echo "<div class='contentHolder' id='error'>".$this->session->flashdata('error')."</div>";
	?>	
	<div id="holder">
		<?=$holder?>
	</div>
	<div id="content">
		<?=$content?>
	</div>
	<div id="sideBar">
		<?=$sideBar;?>
	</div>
</div>

<!--<div id="footer-top"></div>-->

<div id="wrapper">
	<div id="footer">Page rendered in {elapsed_time} seconds</div>
</div>

</body>
</html>  