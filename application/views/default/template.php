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
		echo "<p style='color:green'>".$this->session->flashdata('success')."</p>";
	else if( $this->session->flashdata('error') != NULL)
		echo "<p style='color:red'>".$this->session->flashdata('error')."</p>";
?>
	<div id="header">
		<h1>Welcome to Life Achievements</h1>
		<?=anchor('achievement/display', 'Display Achievements')?>
        <br>
        <?=$this->session->userdata('name');?>
          Your Privileges are: <?=$this->session->userdata('privileges');?>
	</div>
	<div id="content">
		<?=$content?>
	</div>
	<div id="sideBar"><?=$sideBar;?></div>
	<div id="footer">Page rendered in {elapsed_time} seconds</div>
</div>

</body>
</html>  