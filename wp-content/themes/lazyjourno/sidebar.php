
<?php
  $args = array(
          'type' => 'monthly',
          'limit' => 5,
          'post_type' => 'post');
       $sponsorName = get_option( 'sponsor_name' );

       if ($sponsorName) {
          echo "<div id='desktop-sponsor'>";
            get_template_part( 'content-sponsor' );
          echo "</div>";
        }

        if (!is_category( 'podcast' )) {get_template_part( 'latest-podcast-box' );}

        get_template_part( 'subscribe-sidebar' );
?>

  <div class="col-12 sidebar-search">
    <h4>Lazy Search</h4>
    <div>
    <?php get_search_form(); ?>
  </div>
  <h4>Archives</h4>
      <ol class="list-unstyled">
        <?php wp_get_archives( $args ); ?>
      </ol>
  <h4>Elsewhere</h4>
  <ol class="list-unstyled">
    <li><a href="<?php echo get_option('rss'); ?>">RSS</a></li>
    <li><a href="<?php echo get_option('twitter'); ?>">Twitter</a></li>
  </ol>
</div>