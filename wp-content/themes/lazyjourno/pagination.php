<?php
global $post; ?>


        <nav class="row pager">
            <div class="col-6 d-flex justify-content-start pl-0">
              <?php if( get_previous_posts_link() ) { ?>
                <div class="pagination-link"><?php previous_posts_link( 'Newer' ); ?></div>
                <?php } ?>
            </div>
            <div class="col-6 d-flex justify-content-end pr-0">
              <?php if( get_next_posts_link() ) { ?>
                <div class="pagination-link"><?php next_posts_link( 'Older' ); ?></div>
              <?php } ?>
            </div>
        </nav>