<html>
<head>
  
<title><?=$title;?></title>
<link rel="stylesheet" href='<?=base_url()?>assets/css/layout.css' type="text/css" media="screen, projection" /> 
<link rel="stylesheet" href='<?=base_url()?>assets/css/style.css' type="text/css" media="screen, projection" /> 
</head>

<body>
<div id="wrapper">
	<div id="header"><h1>Welcome to Life Achievements</h1></div>
	<div id="content"><?=$content;?></div>
	<div id="sideBar"><?=$sideBar;?></div>
	<div id="footer">Page rendered in {elapsed_time} seconds</div>
</div>

</body>
</html>  