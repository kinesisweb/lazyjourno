<?php

function lazyjourno_sponsor_custom_settings(){
	register_setting( 'lazyjourno-sponsor-settings-group', 'sponsor_intro' );
	register_setting( 'lazyjourno-sponsor-settings-group', 'sponsor_name' );
	register_setting( 'lazyjourno-sponsor-settings-group', 'sponsor_link' );
	register_setting( 'lazyjourno-sponsor-settings-group', 'sponsor_logo' );
	register_setting( 'lazyjourno-sponsor-settings-group', 'sponsor_display' );
	add_settings_section( 'lazyjourno-sponsor-settings', 'Sponsor Settings', 'lazyjourno_sponsor_settings', 'sitesponsor');
	add_settings_field( 'sponsor-intro', 'Introductory Text', 'lazyjourno_sponsor_intro', 'sitesponsor', 'lazyjourno-sponsor-settings' );
	add_settings_field( 'sponsor-name', 'Sponsor Name', 'lazyjourno_sponsor_name', 'sitesponsor', 'lazyjourno-sponsor-settings' );
	add_settings_field( 'sponsor-link', 'Sponsor Link', 'lazyjourno_sponsor_link', 'sitesponsor', 'lazyjourno-sponsor-settings' );
	add_settings_field( 'sponsor-logo', 'Sponsor Logo', 'lazyjourno_sponsor_logo', 'sitesponsor', 'lazyjourno-sponsor-settings' );
	add_settings_field( 'sponsor-display', 'Display Style', 'lazyjourno_sponsor_display', 'sitesponsor', 'lazyjourno-sponsor-settings' );
}

function lazyjourno_sponsor_display() {
	$sponsorDisplay = esc_attr( get_option( 'sponsor_display' ) );
	echo '<select name="sponsor_display"><option value="" disabled>-- Select Display Style for Sponsorship Message --</option><option value="overlay"' . selected( $sponsorDisplay, 'overlay', false ) . '>Overlay Text on Logo</option><option value="text"' . selected( $sponsorDisplay, 'text', false ) . '>Text Only</option><option value="underneath"' . selected( $sponsorDisplay, 'underneath', false ) . '>Display Text Underneath Logo</option></select>';
}

function lazyjourno_sponsor_name() {
	$sponsorName = esc_attr( get_option( 'sponsor_name' ) );
	echo '<input type="text" name="sponsor_name" value="'.$sponsorName.'" placeholder="Enter Sponsor\'s Full Name" style="width: 25%; border: 1px solid #ccc;">';
}

function lazyjourno_sponsor_intro() {
	$sponsorIntro = esc_attr( get_option( 'sponsor_intro' ) );
	echo '<input type="text" name="sponsor_intro" value="'.$sponsorIntro.'" placeholder="Text to introduce the sponsor" style="width: 25%; border: 1px solid #ccc;">';
}

function lazyjourno_sponsor_link() {
	$sponsorLink = esc_attr( get_option( 'sponsor_link' ) );
	echo '<input type="text" name="sponsor_link" value="'.$sponsorLink.'" placeholder="URL for the sponsor section to link to" style="width: 35%; border: 1px solid #ccc;">';
}

function lazyjourno_sponsor_logo() {
	media_selector_settings_page_callback();
}

function lazyjourno_sponsor_settings() {
	echo "Update the site's sponsor details by adding them below. Changes will be reflected immediately upon saving.";
}

function lazyjourno_create_sponsor_page() {
	require_once( get_template_directory() . '/sponsor/addmedia.php');
	require_once( get_template_directory() . '/sponsor/admin.php');
}