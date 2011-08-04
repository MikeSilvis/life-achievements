<div class="contentTitle">
	<div class='title' style="font-size:2em">Mike Silvis</div>
	<div class="contentHolder">
		<div id="avatarPics">
			<img src="https://graph.facebook.com/<?=$user->getUID()?>/picture" alt="<?=$user->getName()?>" class="avatar"/>
			<br><br>
			<div class="scoreLarge">
				41
			</div>
		</div> 
		<div id="userBio">
			<p>	<strong>Location:		</strong> 	<?=$user->getLocation()?>									</p>
			<p>	<strong>Age: 			</strong>	<?=$user->getAge()?>										</p>
			<p>	<strong>Last Login:  	</strong>	<?=date('F jS, Y', strtotime($user->getLastLogin()));?>		</p>
			<p>	<strong>Registered: 	</strong>	<?=date('F jS, Y', strtotime($user->getRegistered()));?>	</p>
			<div id="fb-root"></div>
			
			<!-- Facebook Button -->
			<div style="float:left; width:60px;">
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
			
		</div>
	</div>
</div>