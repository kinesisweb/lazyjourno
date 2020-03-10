<?php

function get_first_embed_media($post_id) {

    $post = get_post($post_id);
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content );

    if( !empty($embeds) ) {
        //check what is the first embed containg video tag, youtube or vimeo
        foreach( $embeds as $embed ) {
            if( strpos( $embed, 'audio' ) || strpos( $embed, 'playlist' ) ) {
                return $embed;
            }
        }

    } else {
        //No video embedded found
        return false;
    }

}