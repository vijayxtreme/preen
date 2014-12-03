<div id="secondary">

<ul id="sidebar-nav">
	<li><a class='sidelist <?php if(is_page('work')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/work">WORK</a></li>
	<li><a class='sidelist <?php if(is_page('intent')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/intent">INTENT</a></li>
	<li><a class='sidelist <?php if(is_home() || is_page('blog')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/blog">NEWS</a></li>
	<li><a class='sidelist <?php if(is_page('team')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/team">TEAM</a></li>
	<li><a class='sidelist <?php if(is_page('awards')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/awards">AWARDS</a></li>
	<li><a class='sidelist <?php if(is_page('press')){ ?>selected<?php }?>' href="<?php bloginfo('url'); ?>/press">PRESS</a></li>
	<li><a class='sidelist' target="_blank" href="http://www.preenshop.com">PREENSHOP</a></li>
		<?php 
		$url = get_bloginfo('url');
		
	if (is_user_logged_in() ) {
	  echo '<li ><a class="admin-styles" href="'.$url.'/upload">UPLOAD</a></li>';
      echo '<li ><a class="admin-styles" href="'.$url.'/wp-admin">ADMIN</a></li>';
    }else{
	   echo '<li ><a class="admin-styles" href="'.$url.'/wp-admin">LOGIN</a></li>';
    }
	
?>
</ul>

<div id="contact">
<?php if(is_page('awards')){ ?>
	
<?php }elseif(is_page('press')) {?>
	
<?php }else { ?>
	<!-- <p id="design-bird"></p> -->
<?php } ?> 
</div>

</div>

	