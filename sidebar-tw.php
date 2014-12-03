<div id="secondary">

<ul id="sidebar-nav">
	<li><a <?php if(is_page('intent')){ ?>class="selected"<?php }?> href="<?php bloginfo('url'); ?>/intent">INTENT</a></li>
	<li><a <?php if(is_page('team')){ ?>class="selected"<?php }?> href="<?php bloginfo('url'); ?>/team">TEAM</a></li>
<!-- 	<li><a <?php// if(is_page('bio')){ ?>class="selected"<?php// }?> href="bio">CLIENTS</a></li> -->
	<li><a <?php if(is_page('press')){ ?>class="selected"<?php }?> href="<?php bloginfo('url'); ?>/press">PRESS</a></li>
	<li><a <?php if(is_page('awards')){ ?>class="selected"<?php }?> href="<?php bloginfo('url'); ?>/awards">AWARDS</a></li>
	<li><a target="_blank" href="http://www.preenshop.com">PREENSHOP</a></li>
	<li><a <?php if(is_home()){ ?>class="selected"<?php }?> href="<?php bloginfo('url'); ?>">WORK</a></li>
	<?php 
	if (is_user_logged_in() ) {
      echo "<li style=''><a href='<?php bloginfo('url'); ?>/wp-admin'>ADMIN</a></li>";
    }
	
?>
</ul>

<?php if(is_page('awards')){ ?> 
<?php }elseif(is_page('press')) {?>
	
<?php }else { ?>

<?php } ?> 
<?php if(is_page('bio')){ ?>

<?php }?> 
<a id="twitter" href="http://www.twitter.com" target="_blank">Twitter</a>
<div id="contact">
	831 CHUNG KING ROAD
	<br />LOS ANGELES, CA 90012
	<br />TEL +1 (213) 625-2100
	<br /><a href="mailto:info@preened.com">INFO@PREENED.COM</a>
</div>
</div>

<a id="preenlogo" href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" /></a>