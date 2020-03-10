 </div><!-- /.container -->
    <footer class="lazyjourno-footer">
      <div class="footer-row"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?></div>
      <div class="footer-row">
        <div class="social-links">
          <ol class="list-unstyled">
            <li><a href="<?php echo get_option('rss'); ?>" title="RSS Feed"><i class="fas fa-rss"></i></a></li>
            <li><a href="<?php echo get_option('twitter'); ?>" title="View Twitter Feed"><i class="fab fa-twitter"></i></a></li>
          </ol>
        </div>
      </div>
      <div class="footer-row">
        <div class="col-12 text-center" id="copyright-info">
          <?php echo get_option('copyright'); ?>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>