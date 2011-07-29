<div>
  <?php if(!$fb_data['me']): ?>
  Please login with your FB account: <a href="<?php echo $fb_data['loginUrl']; ?>&scope=email,user_birthday,user_location">login</a>
  <? endif; ?>
</div>