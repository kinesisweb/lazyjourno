<?php 

    $sponsorName = get_option( 'sponsor_name' );
    $sponsorIntro = get_option( 'sponsor_intro' );
    $sponsorLogoID = get_option( 'sponsor_logo' );
    $sponsorDisplay = get_option( 'sponsor_display' );
    $sponsorLink = get_option( 'sponsor_link' );


    if ($sponsorDisplay == "underneath")  {
        if ($sponsorLink) { ?>
            <a href="<?php echo $sponsorLink ?>" target="_blank">
        <?php } ?>
        <div class="col-12" id="sponsor-sidebar">
            <div class="col-12 text-center sponsor-bookend" id="sponsor-header">
                <span><?php echo $sponsorIntro; ?></span>
            </div>
            <div class="col-12" id="sponsor-logo">
                 <div><?php echo wp_get_attachment_image( $sponsorLogoID, 'medium' ); ?></div>
            </div>
            <div class='col-12 text-center sponsor-bookend' id="sponsor-footer">
                <span><?php echo $sponsorName; ?></span>
            </div>
        </div>
        <?php if ($sponsorLink) { ?>
        </a>
    <?php }
    }
        ?>