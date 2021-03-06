<?php
/**
 * Class with management functions for Subscribe to Comments Reloaded
 * @author reedyseth
 * @since 27-Mar-2018
 * @version 1.0.0
 */
namespace stcr;

// Avoid direct access to this piece of code
if ( ! function_exists( 'add_action' ) ) {
    header( 'Location: /' );
    exit;
}

class stcr_i18n
{
    private $js_subs_translation = array();
    private $wp_locale = null;

    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'register_js_subs_translation' ) );
        global $wp_locale;
        $this->wp_locale = get_locale();
    }

    /**
     * Enqueue a script a translated array into a Object Name that will be use in the handle JS file.
     *
     * @since 28-Mar-2018
     * @author reedyseth
     * @param string $handle Script handle that will be enqueue
     * @param string $object_name Name for the JavaScript object. Passed directly, so it should be qualified JS variable.
     *                            Example: '/[a-zA-Z0-9_]+/'.
     * @param string $l10n The data itself. The data can be either a single or multi-dimensional array.
     */
    public function stcr_localize_script( $handle, $object_name, $l10n )
    {
        wp_localize_script( $handle, $object_name, $l10n );
    }
    /**
     * Create the translation array for the plugin jQuery Datatables.
     *
     * @since 28-Mar-2018
     * @author reedyseth
     */
    public function register_js_subs_translation()
    {
        $translation_array = array (
            "decimal"        => __( " ", "subscribe-reloaded" ),
            "emptyTable"     => __( "No data available in table", "subscribe-reloaded" ),
            "info"           => __( "Showing _START_ to _END_ of _TOTAL_ entries", "subscribe-reloaded" ),
            "infoEmpty"      => __( "Showing 0 to 0 of 0 entries", "subscribe-reloaded" ),
            "infoFiltered"   => __( "(filtered from _MAX_ total entries)", "subscribe-reloaded" ),
            "infoPostFix"    => __( " ", "subscribe-reloaded" ),
            "thousands"      => __( ",", "subscribe-reloaded" ),
            "lengthMenu"     => __( "Show _MENU_ entries", "subscribe-reloaded" ),
            "loadingRecords" => __( "Loading...", "subscribe-reloaded" ),
            "processing"     => __( "Processing...", "subscribe-reloaded" ),
            "search"         => __( "Search", "subscribe-reloaded" ),
            "zeroRecords"    => __( "No matching records found", "subscribe-reloaded" ),
            "paginate"       => array(
                "first"    => __( "First", "subscribe-reloaded" ),
                "last"     => __( "Last", "subscribe-reloaded" ),
                "next"     => __( "Next", "subscribe-reloaded" ),
                "previous" => __( "Previous", "subscribe-reloaded" )
            ),
            "aria"           => array(
                "sortAscending" => __( "activate to sort column ascending", "subscribe-reloaded" ),
                "sortDescending"=> __( "activate to sort column descending", "subscribe-reloaded" )
            ),
            "langTextDirection" => $this->get_text_direction()
        );

        $this->set_js_subs_translation( $translation_array );
    }
    /**
     * @return mixed
     */
    public function get_js_subs_translation()
    {
        return $this->js_subs_translation;
    }

    /**
     * @param mixed $translation_array
     */
    public function set_js_subs_translation( $translation_array )
    {
        $this->js_subs_translation = array_merge( $this->get_js_subs_translation(), $translation_array );
    }

    /**
     * @return null
     */
    public function get_wp_locale()
    {
        return $this->wp_locale;
    }

    public function get_text_direction()
    {
        if ( is_rtl() )
        {
            $text_direction = "rtl";
        }
        else
        {
            $text_direction = "ltr";
        }

        return $text_direction;
    }
    /**
     * @param null $wp_locale
     */
    public function set_wp_locale($wp_locale)
    {
        $this->wp_locale = $wp_locale;
    }
}