<!doctype HTML>
<html>
<head>
<title>Preen</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width maximum-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/style_m.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.11.1.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"></script>
</head>
<body>
<div id="mobile_nav">
	<ul>
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
</div>	
<div id="main_body">
<div id="mobile-header">
	<a href="<?php bloginfo('url'); ?>/"><img class="preenlogo" src="<?php bloginfo('stylesheet_directory'); ?>/images/preenlogo.png" /></a>
	<span><button class="shelf">≡</button></span>
</div>
<div class="wrapper">

<div id="header"></div>
<div id="contact-area">
<div class="socialmedia">
	<ul class="socialicons">
		<li><a target="_blank" href="mailto:info@preened.com"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/email.jpg" /></a></li>
		<li><a target="_blank" href="http://instagram.com/preeninc"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/in.jpg" /></a></li>
		<li><a target="_blank" href="http://www.pinterest.com/preeninc/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/pn.jpg" /></a></li>
		<li><a target="_blank" href="https://www.facebook.com/preeninc"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/fb.jpg" /></a></li>
		<li><a target="_blank" href="https://plus.google.com/110693999040436855322" rel="publisher"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/gp.jpg" /></a></li>
		<li><a target="_blank" href="https://www.linkedin.com/company/preen-inc-"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ln.jpg" /></a></li>
		<li><a target="_blank" href="http://www.youtube.com/user/preeninc"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/yt.jpg" /></a></li>
		<li><a target="_blank" href="https://twitter.com/preeninc"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/tw.jpg" /></a></li>
		<li><a target="_blank" href="https://soundcloud/preeninc"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sn.jpg" /></a></li>
	</ul>
</div>
<div id="google-map" onclick="location.href='#';" style="cursor: pointer;">

	<a target="_blank" href="https://www.google.com/maps/preview?ie=UTF-8&fb=1&gl=us&sll=34.0654793,-118.238679&sspn=0.0273035,0.0439464&q=831+Chung+King+Rd,+Los+Angeles,+CA+90012&ei=cOkHVNPaM8SuggTulIC4AQ&ved=0CB8Q8gEwAA">831 CHUNG KING ROAD
	LOS ANGELES, CA 90012</a>
	TEL +1 (213) 625-2100
	</div>
</div>


