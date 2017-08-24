<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

wp_clear_scheduled_hook( 'investment_manager_delete_old_previews' );
wp_clear_scheduled_hook( 'investment_manager_check_for_expired_investments' );

wp_trash_post( get_option( 'investment_manager_submit_investment_form_page_id' ) );
wp_trash_post( get_option( 'investment_manager_investment_dashboard_page_id' ) );
wp_trash_post( get_option( 'investment_manager_investments_page_id' ) );

$options = array(
	'wp_investment_manager_version',
	'investment_manager_per_page',
	'investment_manager_hide_filled_positions',
	'investment_manager_enable_categories',
	'investment_manager_enable_default_category_multiselect',
	'investment_manager_category_filter_type',
	'investment_manager_user_requires_account',
	'investment_manager_enable_registration',
	'investment_manager_registration_role',
	'investment_manager_submission_requires_approval',
	'investment_manager_user_can_edit_pending_submissions',
	'investment_manager_submission_duration',
	'investment_manager_allowed_application_method',
	'investment_manager_submit_investment_form_page_id',
	'investment_manager_investment_dashboard_page_id',
	'investment_manager_investments_page_id',
	'investment_manager_installed_terms',
	'investment_manager_submit_page_slug',
	'investment_manager_investment_dashboard_page_slug'
);

foreach ( $options as $option ) {
	delete_option( $option );
}