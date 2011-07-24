<div>
  <?php if(!$fb_data['me']): ?>
  Please login with your FB account: <a href="<?php echo $fb_data['loginUrl']; ?>&scope=email,user_birthday,user_location">login</a>
  <? endif; ?>
</div>

<? /*
  Like Mike's Profile? Leave him a message.
  <div id="fb-root"></div>
  <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
  <fb:comments href="http://axiom-films.com/life/index.php/login" num_posts="30" width="500"></fb:comments>
*/ ?>