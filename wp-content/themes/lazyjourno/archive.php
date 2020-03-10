<?php get_header(); ?>
      <div class="row mt-3">

    <div class="col-md-9 col-sm-12 blog-main">

          <?php

            if ( have_posts() ) : while ( have_posts() ) : the_post();

              get_template_part( 'content', get_post_format() );
              $terms = get_the_terms( $post->ID, 'predictions' );
              if ($terms) {
                  foreach($terms as $term) {
                    echo $term->name;
                  } 
              }

          endwhile;
          
        get_template_part( 'pagination' );


          endif; ?>

        </div><!-- /.blog-main -->

        <div class="col-md-3 col-sm-12 mb-3" id="lazyjourno-sidebar"><?php get_sidebar(); ?></div>

      </div><!-- /.row -->

<?php get_footer(); ?>