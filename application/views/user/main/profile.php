<img src="https://graph.facebook.com/<?=$user->getUID()?>/picture?type=large" alt=""/>
<h1><?=$user->getName()?>'s Profile</h1>
<p>
	<strong> Location:  </strong> <?=$user->getLocation()?>
	<strong> Age:		</strong> <?=$user->getAge()?>
</p>
<p>
	<strong> Email:		</strong> <?=$user->getEmail()?>
	<strong> Last Login:		</strong> <?=$user->getLastLogin()?>
	<strong> Registered On:		</strong> <?=$user->getRegistered()?>
</p>
<p>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<fb:comments href="<?=current_url()?>" num_posts="30" width="500"></fb:comments>
</p>