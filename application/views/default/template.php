<html>
<head>
<title><?=$title;?></title>
<link rel="stylesheet" href='<?=base_url()?>assets/css/layout.css' type="text/css" media="screen, projection" /> 
<link rel="stylesheet" href='<?=base_url()?>assets/css/style.css' type="text/css" media="screen, projection" /> 
<meta property="fb:app_id" content="229353873772038">
<?=$_scripts?>
<?=$_styles?>
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
					echo " | ". anchor('user/logout','Log out');
				}
				else 
				    echo '<a href="'.$fb_data["loginUrl"].'&scope=email,user_birthday,user_location">login</a>';			
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