
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo get_bloginfo( 'description' ) ?>">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body>
<div id="lightbox" class="lightbox-element">
      <script src="https://www.google.com/recaptcha/api.js?render=6Lcyu5AUAAAAAKaBWiqoN-FEpvZqelGjQwgjuqi0"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lcyu5AUAAAAAKaBWiqoN-FEpvZqelGjQwgjuqi0', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
    <div id="lightbox-flex" class="lightbox-element">
        <div id="lightbox-close" class="lightbox-element">X</div>
        <div id="lightbox-content" class="lightbox-element">
            <div id="lightbox-recaptcha-container">
                <div id="lightbox-recaptcha"></div>
                <div id="lightbox-recaptcha-text"><span>This site is protected by reCAPTCHA and the Google
    <a href="https://policies.google.com/privacy">Privacy Policy</a> and
    <a href="https://policies.google.com/terms">Terms of Service</a> apply.</span></div>
            </div>



   <?php es_subbox($namefield = "YES", $desc = "", $group = "Public"); ?>



        </div>
    </div>
</div>
<div class="container">

<?php 
    if ( is_category('podcast') || in_category('podcast')) {
      get_template_part('podcast-header');
  }
  else {
?>
<header>
      <div class="row align-items-center">
            <div class="col-6" id="site-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() . '/img/logo.svg' ?>"></a>
            </div>
            <div class="col-6">
                <div class="social-links">
                    <a href="<?php echo get_option('rss'); ?>" title="RSS Feed"><i class="fas fa-rss"></i></a>
                    <a href="<?php echo get_option('twitter'); ?>" title="View Twitter Feed"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
      </div>
</header>
<?php
    } 
 ?>
<div class="row<?php if ( is_category('podcast') || in_category('podcast')) {echo " podcast-navbar"; } ?>">
  <nav class="navbar navbar-expand-md<?php if ( is_category('podcast') || in_category('podcast')) {echo " podcast-navbar-background"; } ?>" id="navbar">

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
     <?php wp_nav_menu( array ('menu_class' => 'navbar-nav', 'container' => false, 'theme_location' => 'header-menu', 'walker' => new WP_Bootstrap_Navwalker()) ); ?>
      <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle dropdown-click" href="javaScript:void(0);">
        Sections
      </a>
      <div class="dropdown-menu">
        <?php $menu_items = wp_get_nav_menu_items( 'Tag Section Menu' ); 

          foreach ($menu_items as $item) {
                echo '<a class="dropdown-item" href="' . $item->url . '">' . $item->title . '</a>';
              }
        ?>
      </div>
    </li>
    <li class="nav-item">
      <div class="lazyjourno-search"><?php get_search_form(); ?></div>
    </li>
  </ul>
  </div> 
</nav>
</div>