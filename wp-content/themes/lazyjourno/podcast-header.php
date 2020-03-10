<header class="row podcast-header">
      <div class="row align-items-center" style="width:100%;">
            <div class="col-6" id="site-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() . '/img/logo.svg' ?>"></a>
                <div class="header-podcast-logo">
                    <img src="<?php echo get_template_directory_uri() . '/img/podcast-logo.png' ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="social-links">
                    <a href="<?php echo get_option('rss'); ?>" title="RSS Feed"><i class="fas fa-rss"></i></a>
                    <a href="<?php echo get_option('twitter'); ?>" title="View Twitter Feed"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
      </div>
</header>
