<?php get_header(); 
  if(!is_paged()) {
        $sticky = get_option( 'sticky_posts' );

        $args = array( 'numberposts' => '1', 'post__not_in' => $sticky, 'post_status' => 'publish' );
        $recent_posts = wp_get_recent_posts( $args );
        foreach( $recent_posts as $recent ){
         $latest = $recent["ID"];
        }

        set_query_var( 'ft_background', get_the_post_thumbnail_url($latest,'full'));
        set_query_var( 'ft_title', get_the_title($latest));
        set_query_var( 'ft_url', get_post_permalink($latest));
        get_template_part( 'content-headline');
    ?>

<div class="row stickied-posts">
        <?php
        $args = array(
          'posts_per_page' => 3,
          'post__in'  => $sticky,
          'ignore_sticky_posts' => 1
        );
        $query = new WP_Query( $args );
            if ( $query -> have_posts() ) : while ( $query -> have_posts() ) : $query -> the_post();
                get_template_part( 'content-sticky'); 
            endwhile;
          endif;
        ?>
</div>

    <?php get_template_part( 'subscribe' ); ?>

    <?php
     //  $sponsorName = get_option( 'sponsor_name' );
    //    if ($sponsorName) {
    //        get_template_part( 'content-sponsor' );
    //    }
  }
      ?>
<div class="row mt-2">
    <div class="col-lg-9 col-sm-12">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        if (is_paged()) {
          echo "<div class='page-number'>" . $paged . "</div>";
        }
        GLOBAL $post_index;
        $args = array(
            'post_type'   => array('post'),
            'posts_per_page' => 10,
            'paged' => $paged,
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        );
        $new_post_loop = new WP_Query( $args );
        $count = 1;
        $sponsorName = get_option( 'sponsor_name' );
        if ( $new_post_loop -> have_posts() ) : while ( $new_post_loop -> have_posts() ) : $new_post_loop -> the_post();
            if ($post->ID == $latest) continue;
            else if ($count == 3 && $sponsorName) {
              echo "<div id='mobile-sponsor' class='row'>";
              get_template_part( 'content-sponsor' );
              echo "</div>";
            }
            echo "<div class='blog-post'>";
            $post_index = $new_post_loop->current_post;
            get_template_part( 'content', get_post_format() );
            echo "</div>";
            $count++;
        endwhile;
        
        get_template_part( 'pagination' );

        endif; ?>
    </div>

    <div class="col-lg-3 col-sm-12" id="lazyjourno-sidebar"><?php get_template_part( 'sidebar' ); ?></div>

</div>
<?php get_footer(); ?>