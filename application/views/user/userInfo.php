<div id="avatarPics">
	<img src="https://graph.facebook.com/<?=$user->getUID()?>/picture" alt="<?=$user->getName()?>" class="avatar"/>
	<br><br>
	<div class="scoreLarge">
		<?=$user->getTotalPoints()?>
	</div>
</div>
<div class="userBio" style="padding-left:80px;">
	<p>	<strong>Location:		</strong> 	<?=$user->getLocation()?>									</p>
	<p>	<strong>Age: 			</strong>	<?=$user->getAge()?>										</p>
</div>
<div class="userBio">
	<p>	<strong>Last Login:  	</strong>	<?=date('F jS, Y', strtotime($user->getLastLogin()));?>		</p>
	<p>	<strong>Registered: 	</strong>	<?=date('F jS, Y', strtotime($user->getRegistered()));?>	</p>
</div>
<div class="userBio">
	<!-- Facebook Button -->
	<div style="float:left; width:60px;">
		<div id="fb-root"></div>
		<script src="http://connect.facebook.net/en_US/all.js#appId=262129643813756&amp;xfbml=1"></script>
		<fb:like href="<?=current_url()?>" send="false" layout="box_count" width="200" show_faces="false" font=""></fb:like>
	</div>
	
	<!-- Twitter Button -->
	<div style="float:left; width:60px;">
		<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
	</div>
	
	<!-- Google+ Button -->
	<div style="float:left; width:60px;">
		<!-- Place this tag where you want the +1 button to render -->
		<g:plusone size="tall"></g:plusone>
		<!--  Place this tag after the last plusone tag -->
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>			
	</div>
</div><!-- end userBio for social media -->
<div style="float:right; padding-top:20px;">
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-6445244283017686";
	/* life achievements ads */
	google_ad_slot = "2508947736";
	google_ad_width = 728;
	google_ad_height = 90;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
</div>