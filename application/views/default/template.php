<!DOCTYPE html>
<html>
<head>
<title><?=$title;?></title>
<!-- My Style Sheets -->
<link rel="stylesheet" href='<?=base_url()?>assets/css/layout.css' type="text/css" media="screen, projection" /> 
<link rel="stylesheet" href='<?=base_url()?>assets/css/style.css' type="text/css" media="screen, projection" />
<!-- jquery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!-- fancybox -->
<script type="text/javascript" src="<?=base_url()?>assets/js/plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/js/plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<meta property="fb:app_id" content="229353873772038">
<?=$_scripts?>
<?=$_styles?>
<script type="text/javascript">
	$(document).ready(function() {
			$(".ajax").fancybox();
	});
</script>
</head>
<body>
<div id="wrapper">
<?
	if ($this->session->flashdata('success') != NULL)
		echo "<div style='color:green'>".$this->session->flashdata('success')."</div>";
	else if( $this->session->flashdata('error') != NULL)
		echo "<div style='color:red'>".$this->session->flashdata('error')."</div>";
?>
	<div id="header">
		<div id="logo"></div>
		<div id="search">
			<form>
				<input type="text" value="Search" id="searchBox">
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