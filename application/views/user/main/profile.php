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
	<?=$user->getID()?>
</p>