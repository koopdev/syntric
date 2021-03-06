<?php
//
// todo: list
// remove class['page'] custom field and all references to it
// current user, available anywhere on this page
// Speed up admin load time by not loading WP Custom Fields
	// https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
	add_filter( 'acf/settings/remove_wp_meta_box', '__return_true' );
	/**
	 * Include Syntric App files
	 */
	require get_template_directory() . '/syntric-apps/syntric-acf.php';
	require get_template_directory() . '/syntric-apps/syntric-admin-columns.php';
	require get_template_directory() . '/syntric-apps/syntric-calendars.php';
	require get_template_directory() . '/syntric-apps/syntric-categories.php';
	require get_template_directory() . '/syntric-apps/syntric-microblogs.php';
	require get_template_directory() . '/syntric-apps/syntric-google-maps.php';
	require get_template_directory() . '/syntric-apps/syntric-jumbotrons.php';
	require get_template_directory() . '/syntric-apps/syntric-media-enhancements.php';
	require get_template_directory() . '/syntric-apps/syntric-organizations.php';
	require get_template_directory() . '/syntric-apps/syntric-classes.php';
	require get_template_directory() . '/syntric-apps/syntric-people.php';
	require get_template_directory() . '/syntric-apps/syntric-facebook-pages.php';
	require get_template_directory() . '/syntric-apps/syntric-nav-menus.php';
	require get_template_directory() . '/syntric-apps/syntric-filters.php';
	require get_template_directory() . '/syntric-apps/syntric-page-widgets.php';
	require get_template_directory() . '/syntric-apps/syntric-post-settings.php';
	require get_template_directory() . '/syntric-apps/syntric-migration.php';
	require get_template_directory() . '/syntric-apps/syntric-settings.php';
	require get_template_directory() . '/syntric-apps/syntric-sidebars.php';
	require get_template_directory() . '/syntric-apps/syntric-widgets.php';
	require get_template_directory() . '/syntric-apps/syntric-data-functions.php';
	require get_template_directory() . '/syntric-apps/class-syntric-nav-menu-walker.php';
	//require get_template_directory() . '/syntric-apps/syntric-nestable.php';
	// If production, remove all whitespace
//require get_template_directory() . '/syntric-apps/syntric-forms.php';
//require get_template_directory() . '/syntric-apps/syntric-contact.php';
//require get_template_directory() . '/syntric-apps/syntric-twitter-feeds.php';
//require get_template_directory() . '/syntric-apps/syntric-google-analytics.php';
	/**
	 * Register option pages using ACF
	 */
	if ( function_exists( 'acf_add_options_page' ) ) {
		$organization_type_label  = syn_get_organization_type_label();
		$organization_is_school   = syn_organization_is_school();
		$organizations_type_label = syn_get_organizations_type_label();
		// Organization
		acf_add_options_page( [
			'page_title' => $organization_type_label,
			'menu_title' => $organization_type_label,
			'menu_slug'  => 'syntric-organization',
			'capability' => 'edit_others_pages',
			'position'   => '59.1',
			'redirect'   => false,
		] );
		// Organizations
		acf_add_options_sub_page( [
			'page_title'  => $organizations_type_label,
			'menu_title'  => $organizations_type_label,
			'menu_slug'   => 'syntric-organizations',
			'parent_slug' => 'syntric-organization',
			'capability'  => 'edit_others_pages',
		] );
		// People
		/*acf_add_options_sub_page( [
			'page_title'  => 'People',
			'menu_title'  => 'People',
			'menu_slug'   => 'syntric-people',
			'parent_slug' => 'syntric-organization',
			'capability'  => 'edit_others_pages',
		] );*/
		if ( $organization_is_school ) {
			// Academic Calendar
			acf_add_options_sub_page( [
				'page_title'  => 'Acedemic Calendar',
				'menu_title'  => 'Acedemic Calendar',
				'menu_slug'   => 'syntric-academic-calendar',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			// Departments
			acf_add_options_sub_page( [
				'page_title'  => 'Departments',
				'menu_title'  => 'Departments',
				'menu_slug'   => 'syntric-departments',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			// Buildings
			acf_add_options_sub_page( [
				'page_title'  => 'Buildings/Facilities',
				'menu_title'  => 'Buildings',
				'menu_slug'   => 'syntric-buildings',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			// Rooms
			acf_add_options_sub_page( [
				'page_title'  => 'Rooms/Classrooms',
				'menu_title'  => 'Rooms',
				'menu_slug'   => 'syntric-rooms',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			// Periods
			acf_add_options_sub_page( [
				'page_title'  => 'Periods',
				'menu_title'  => 'Periods',
				'menu_slug'   => 'syntric-periods',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			/*// Courses/Classes
			acf_add_options_page( array(
				'page_title' => 'Courses/Classes',
				'menu_title' => 'Courses/Classes',
				'menu_slug'  => 'syntric-courses-classes',
				'capability' => 'manage_options',
				'redirect'   => true,
			) );*/
			// Courses
			acf_add_options_sub_page( [
				'page_title'  => 'Courses',
				'menu_title'  => 'Courses',
				'menu_slug'   => 'syntric-courses',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
			// Classes
			acf_add_options_sub_page( [
				'page_title'  => 'Classes',
				'menu_title'  => 'Classes',
				'menu_slug'   => 'syntric-classes',
				'parent_slug' => 'syntric-organization',
				'capability'  => 'edit_others_pages',
			] );
		}
		// Jumbotrons
		acf_add_options_page( [
			'page_title' => 'Jumbotrons',
			'menu_title' => 'Jumbotrons',
			'menu_slug'  => 'syntric-jumbotrons',
			'capability' => 'edit_others_pages',
			'redirect'   => false,
		] );
		// Google Maps
		acf_add_options_page( [
			'page_title' => 'Google Maps',
			'menu_title' => 'Google Maps',
			'menu_slug'  => 'syntric-google-maps',
			'capability' => 'edit_others_pages',
			'redirect'   => false,
		] );
		// Social Media
		acf_add_options_page( [
			'page_title' => 'Social Media',
			'menu_title' => 'Social Media',
			'menu_slug'  => 'syntric-social-media',
			'capability' => 'edit_others_pages',
			'redirect'   => false,
		] );
		// Lists
		// Appearance > Sidebars & Widgets
		acf_add_options_sub_page( [
			'page_title'  => 'Sidebars & Widgets',
			'menu_title'  => 'Sidebars & Widgets',
			'menu_slug'   => 'syntric-sidebars-widgets',
			'parent_slug' => 'options-general.php',
			'capability'  => 'manage_options',
			'position'    => 1,
		] );
		// Tools > Data Functions
		acf_add_options_sub_page( [
			'page_title'  => 'Data Functions',
			'menu_title'  => 'Data Functions',
			'menu_slug'   => 'syntric-data-functions',
			'parent_slug' => 'tools.php',
			'capability'  => 'manage_options',
		] );
		// Tools > Clonables
		acf_add_options_sub_page( [
			'page_title'  => 'Parked Field Groups',
			'menu_title'  => 'Parked Field Groups',
			'menu_slug'   => 'syntric-clonables',
			'parent_slug' => 'tools.php',
			'capability'  => 'manage_options',
		] );
		// Settings > Google
		acf_add_options_sub_page( [
			'page_title'  => 'Google',
			'menu_title'  => 'Google',
			'menu_slug'   => 'syntric-google',
			'parent_slug' => 'options-general.php',
			'capability'  => 'manage_options',
		] );
		// Settings > ADA Compliance
		/*acf_add_options_sub_page( array(
			'page_title'  => 'ADA Compliance',
			'menu_title'  => 'ADA Compliance',
			'menu_slug'   => 'syntric-ada-compliance',
			'parent_slug' => 'options-general.php',
			'capability'  => 'manage_options',
		) );*/
	}
	/**
	 * Custom role checker - "has role or higher"
	 *
	 * @param $role - syntric, administrator, editor, author, contributor, subscriber
	 *
	 * @return int (1/0 as booleans)
	 */
	function syn_current_user_can( $role ) {
		$current_user = wp_get_current_user();
		$syntric_user = syn_syntric_user();
		if ( $syntric_user instanceof WP_User && $current_user->ID == $syntric_user->ID ) {
			return 1;
		}
		$current_user_roles = $current_user->roles;
		$role_count         = count( $current_user_roles );
		$current_user_role  = ( $role_count ) ? $current_user_roles[ $role_count - 1 ] : 0;
		if ( 'administrator' == $role && $current_user_role == 'administrator' ) {
			return 1;
		}
		if ( 'editor' == $role && in_array( $current_user_role, [ 'editor', 'administrator', ] ) ) {
			return 1;
		}
		if ( 'author' == $role && in_array( $current_user_role, [ 'author', 'editor', 'administrator', ] ) ) {
			return 1;
		}
		if ( 'contributor' == $role && in_array( $current_user_role, [ 'contributor', 'author', 'editor', 'administrator', ] ) ) {
			return 1;
		}
		if ( 'subscriber' == $role && in_array( $current_user_role, [ 'subscriber', 'contributor', 'author', 'editor', 'administrator', ] ) ) {
			return 1;
		}

		return 0;
	}

	// Remove 3rd party plugin hooks
	add_action( 'wp_head', 'syn_remove_plugin_hooks' );
	function syn_remove_plugin_hooks() {
		global $tinymce_templates;
		if ( $tinymce_templates ) {
			//remove_filter( 'post_row_actions', array( $tinymce_templates, 'row_actions' ), 10, 2 );
			//remove_filter( 'page_row_actions', array( $tinymce_templates, 'row_actions' ), 10, 2 );
			remove_action( 'wp_before_admin_bar_render', [
				$tinymce_templates,
				'wp_before_admin_bar_render',
			] );
		}
	}

	/**
	 * Require post_title
	 */
	/*	add_action( 'admin_init', 'syn_force_post_title' );
		add_action( 'edit_form_advanced', 'syn_force_post_title' );
		add_action( 'edit_page_form', 'syn_force_post_title' );
		function syn_force_post_title() {
			echo "<script type='text/javascript'>\n";
			echo "jQuery('#publish').click(function(){
			var testervar = jQuery('[id^=\"titlediv\"]')
			.find('#title');
			if (testervar.val().length < 1)
			{
				jQuery('[id^=\"titlediv\"]').css('background', '#F96');
				setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
				alert('POST TITLE is required');
				setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
				return false;
			}
		});
	  ";
			echo "</script>\n";
		}*/
	function syn_syntric_user() {
		$syntric_user = get_user_by( 'login', 'syntric' );
		if ( ! $syntric_user instanceof WP_User ) {
			$syntric_user = get_user_by( 'email', 'ken@syntric.com' );
		}

		return $syntric_user;
	}

	/**
	 * Remove admin menu and submenu links by role
	 */
	add_action( 'admin_menu', 'syn_admin_menu', 999 );
	function syn_admin_menu() {
		// Remove for everyone
		remove_menu_page( 'link-manager.php' ); // Links
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
		remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
		// Remove for all but Syntric user
		if ( ! syn_current_user_can( 'syntric' ) ) {
			remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=microblog' ); // Post microblog (taxonomy) - this is deprecated
			remove_menu_page( 'jetpack' ); // Jetpack
			remove_menu_page( 'edit-comments.php' ); // Comments
			remove_menu_page( 'tools.php' ); // Tools
			remove_submenu_page( 'options-general.php', 'codepress-admin-columns' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Custom Fields
			remove_menu_page( 'wpmudev' ); // WPMU Dev
			remove_menu_page( 'wp-defender' ); // WP Defender
			remove_submenu_page( 'upload.php', 'wp-smush-bulk' );
		}
		// Remove for all but administrator and above
		if ( ! syn_current_user_can( 'administrator' ) ) {
			//remove_menu_page( 'users.php' ); // Users
			remove_submenu_page( 'index.php', 'update-core.php' );
			remove_menu_page( 'themes.php' ); // Appearance
			remove_menu_page( 'settings.php' ); // Settings
			remove_menu_page( 'admin.php?page=gutenberg' ); // Gutenburg
		}
		// Remove for all but editor and above
		if ( ! syn_current_user_can( 'editor' ) ) {
			remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // Post category (taxonomy)
			remove_menu_page( 'users.php' ); // Users
			remove_menu_page( 'plugins.php' ); // Plugins
			remove_menu_page( 'edit.php?post_type=syn_calendar' ); // Calendars
			remove_menu_page( 'edit.php?post_type=tinymcetemplates' ); // Templates
			remove_submenu_page( 'edit.php?post_type=page', 'nestedpages' );
		}
		// Remove for all but author
		if ( ! syn_current_user_can( 'author' ) ) {
			remove_menu_page( 'index.php' ); // Dashboard
			remove_menu_page( 'admin.php?page=syntric-organization' ); // Organization
			remove_menu_page( 'admin.php?page=syntric-jumbotrons' ); // Jumbotrons
			remove_menu_page( 'admin.php?page=syntric-google-maps' ); // Google Maps
			remove_menu_page( 'admin.php?page=syntric-social-media' ); // Social Media
			remove_menu_page( 'edit.php' ); // Posts
			// All that is left is Profile...
		}
	}

	/**
	 * Customize the admin bar
	 */
	add_action( 'admin_bar_menu', 'syn_admin_bar', 999 );
	function syn_admin_bar( $wp_admin_bar ) {
		//slog($wp_admin_bar);
		// todo: Add targeted links to role specific resources. EG for Teachers - My Page, My Classes, etc..
		// Remove for everyone, everywhere
		$wp_admin_bar->remove_node( 'wp-logo' );
		/**
		 * Site name menu - both frontend and admin
		 *
		 * In admin...
		 *
		 * On frontend..
		 * Original - Appearance + Themes + Widgets + Menus + Header
		 * Redux - Dashboard + Pages + Posts + Media + Organization + Calendars + Jumbotrons + Google Maps + Users + Comments + Customize + Widgets + Sidebars + Social Media
		 */
		if ( is_admin() ) {
			$site_name_node        = $wp_admin_bar->get_node( 'site-name' );
			$site_name_node->title = esc_attr( get_bloginfo( 'name', 'display' ) );
			$wp_admin_bar->add_node( $site_name_node );
		}
		if ( ! is_admin() ) {
			// Remove all nodes from the admin bar
			$wp_admin_bar->remove_node( 'site-name' );
			$wp_admin_bar->remove_node( 'appearance' );
			$wp_admin_bar->remove_node( 'themes' );
			$wp_admin_bar->remove_node( 'widgets' );
			$wp_admin_bar->remove_node( 'menus' );
			$wp_admin_bar->remove_node( 'header' );
			$wp_admin_bar->remove_node( 'search' );
			$wp_admin_bar->remove_node( 'user-info' );
			$wp_admin_bar->remove_node( 'view-site' );
			$wp_admin_bar->remove_node( 'customize' );
			$wp_admin_bar->remove_node( 'new-content' );
			$wp_admin_bar->remove_node( 'comments' );
			//$wp_admin_bar->remove_node( 'my-account' );
			//$wp_admin_bar->remove_node( 'edit' );
			$wp_admin_bar->remove_node( 'new-user' );
			$wp_admin_bar->remove_node( 'new-post' );
			$wp_admin_bar->remove_node( 'new-media' );
			$wp_admin_bar->remove_node( 'new-page' );
			$wp_admin_bar->remove_node( 'new-tinymcetemplates' );
			$wpab_nodes = [];
			// Admin menu
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '01admin', 'Admin', '', '#' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '010dashboard', 'Dashboard', '01admin', '/wp-admin/index.php' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '020pages', 'Pages', '01admin', '/wp-admin/edit.php?post_type=page&page=nestedpages' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '040posts', 'Posts', '01admin', '/wp-admin/edit.php' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '180media', 'Media', '01admin', '/wp-admin/upload.php' );
			if ( syn_current_user_can( 'syntric' ) ) {
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '170comments', 'Comments', '01admin', '/wp-admin/edit-comments.php' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '290fieldgroups', 'Field Groups', '01admin', '/wp-admin/edit.php?post_type=acf-field-group' );
			}
			if ( syn_current_user_can( 'administrator' ) ) {
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '240widgets', 'Widgets', '01admin', '/wp-admin/widgets.php' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '250plugins', 'Plugins', '01admin', '/wp-admin/plugins.php' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '270sidebarswidgets', 'Sidebars & Widgets', '01admin', '/wp-admin/options-general.php?page=syntric-sidebars-widgets' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '280google', 'Google', '01admin', '/wp-admin/options-general.php?page=syntric-google' );
			}
			if ( syn_current_user_can( 'editor' ) ) {
				$departments_active = get_field( 'syn_departments_active', 'option' );
				$buildings_active   = get_field( 'syn_buildings_active', 'option' );
				$rooms_active       = get_field( 'syn_rooms_active', 'option' );
				$periods_active     = get_field( 'syn_periods_active', 'option' );
				$wpab_nodes[]       = syn_new_wp_admin_bar_node( '060organization', syn_get_organization_type_label(), '01admin', '/wp-admin/admin.php?page=syntric-organization' );
				$wpab_nodes[]       = syn_new_wp_admin_bar_node( '070organizations', syn_get_organizations_type_label(), '01admin', '/wp-admin/admin.php?page=syntric-organizations' );
				if ( $departments_active ) {
					$wpab_nodes[] = syn_new_wp_admin_bar_node( '080departments', 'Departments', '01admin', '/wp-admin/admin.php?page=syntric-departments' );
				}
				if ( $buildings_active ) {
					$wpab_nodes[] = syn_new_wp_admin_bar_node( '090buildings', 'Buildings', '01admin', '/wp-admin/admin.php?page=syntric-buildings' );
				}
				if ( $rooms_active ) {
					$wpab_nodes[] = syn_new_wp_admin_bar_node( '100rooms', 'Rooms', '01admin', '/wp-admin/admin.php?page=syntric-rooms' );
				}
				if ( $periods_active ) {
					$wpab_nodes[] = syn_new_wp_admin_bar_node( '110periods', 'Periods', '01admin', '/wp-admin/admin.php?page=syntric-periods' );
				}
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '120courses', 'Courses', '01admin', '/wp-admin/admin.php?page=syntric-courses' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '130classes', 'Classes', '01admin', '/wp-admin/admin.php?page=syntric-classes' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '140calendars', 'Calendars', '01admin', '/wp-admin/edit.php?post_type=syn_calendar' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '150jumbotrons', 'Jumbotrons', '01admin', '/wp-admin/edit.php?post_type=syntric-jumbotrons' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '160maps', 'Maps', '01admin', '/wp-admin/edit.php?post_type=syntric-google-maps' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '190social_media', 'Social Media', '01admin', '/wp-admin/edit.php?post_type=syntric-social-media' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '200templates', 'Templates', '01admin', '/wp-admin/edit.php?post_type=tinymcetemplates' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '230customizer', 'Customizer', '01admin', '/wp-admin/customize.php' );
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '210users', 'Users', '01admin', '/wp-admin/users.php' );
			}
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '02newcontent', 'New', '', '#' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '030newpage', 'New Page', '02newcontent', '/wp-admin/post-new.php?post_type=page' );
			$wpab_nodes[] = syn_new_wp_admin_bar_node( '050newpost', 'New Post', '02newcontent', '/wp-admin/post-new.php' );
			if ( syn_current_user_can( 'syntric' ) ) {
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '300newfieldgroup', 'New Field Group', '02newcontent', '/wp-admin/post-new.php?post_type=acf-field-group' );
			}
			if ( syn_current_user_can( 'administrator' ) ) {
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '260newplugin', 'New Plugin', '02newcontent', '/wp-admin/plugin-install.php' );
			}
			if ( syn_current_user_can( 'editor' ) ) {
				$wpab_nodes[] = syn_new_wp_admin_bar_node( '220newuser', 'New User', '02newcontent', '/wp-admin/user-new.php' );
			}
			sort( $wpab_nodes );
			foreach ( $wpab_nodes as $wpab_node ) {
				$wp_admin_bar->add_node( $wpab_node );
			}
			$edit_node = $wp_admin_bar->get_node( 'edit' );
			if ( $edit_node ) {
				$edit_node->parent = 'top-secondary';
				$wp_admin_bar->add_node( $edit_node );
			}
			$my_account_node        = $wp_admin_bar->get_node( 'my-account' );
			$my_account_node->title = str_replace( 'Howdy, ', '', $my_account_node->title );
			$wp_admin_bar->add_node( $my_account_node );
			$edit_profile_node        = $wp_admin_bar->get_node( 'edit-profile' );
			$edit_profile_node->title = str_replace( 'Edit My Profile', 'Profile', $edit_profile_node->title );
			$wp_admin_bar->add_node( $edit_profile_node );
			$logout_node        = $wp_admin_bar->get_node( 'logout' );
			$logout_node->title = str_replace( 'Log Out', 'Logout', $logout_node->title );
			$wp_admin_bar->add_node( $logout_node );
		}

		return;
		/**
		 * New Content nodes + menu
		 */
		//$new_content_node = $wp_admin_bar->get_node( 'new-content' );
		/*$wp_admin_bar->remove_node( 'new-user' );
		$wp_admin_bar->remove_node( 'new-post' );
		$wp_admin_bar->remove_node( 'new-media' );
		$wp_admin_bar->remove_node( 'new-page' );
		$wp_admin_bar->remove_node( 'new-tinymcetemplates' );*/
		/*$new_content_nodes = [];
		// Page
		$new_page_node         = new stdClass();
		$new_page_node->id     = 'new_page';
		$new_page_node->title  = 'Page';
		$new_page_node->parent = 'new-content';
		$new_page_node->href   = '/wp-admin/post-new.php?post_type=page';
		$new_page_node->group  = '';
		$new_page_node->meta   = [];
		$new_content_nodes[]   = $new_page_node;
		// Post
		$new_post_node         = new stdClass();
		$new_post_node->id     = 'new_post';
		$new_post_node->title  = 'Post';
		$new_post_node->parent = 'new-content';
		$new_post_node->href   = '/wp-admin/post-new.php';
		$new_post_node->group  = '';
		$new_post_node->meta   = [];
		$new_content_nodes[]   = $new_post_node;
		// Media
		$new_media_node         = new stdClass();
		$new_media_node->id     = 'new_media';
		$new_media_node->title  = 'Media';
		$new_media_node->parent = 'new-content';
		$new_media_node->href   = '/wp-admin/media-new.php';
		$new_media_node->group  = '';
		$new_media_node->meta   = [];
		$new_content_nodes[]    = $new_media_node;
		if ( syn_current_user_can( 'editor' ) ) {
			// User
			$new_user_node         = new stdClass();
			$new_user_node->id     = 'new_user';
			$new_user_node->title  = 'User';
			$new_user_node->parent = 'new-content';
			$new_user_node->href   = '/wp-admin/user-new.php';
			$new_user_node->group  = '';
			$new_user_node->meta   = [];
			$new_content_nodes[]   = $new_user_node;
		}
		sort( $new_content_nodes );
		foreach ( $new_content_nodes as $new_content_node ) {
			$wp_admin_bar->add_node( $new_content_node );
		}*/
		/**
		 * Account menu
		 */
		/*$my_account_node        = $wp_admin_bar->get_node( 'my-account' );
		$my_account_node->title = str_replace( 'Howdy, ', '', $my_account_node->title );
		$wp_admin_bar->add_node( $my_account_node );
		$edit_profile_node        = $wp_admin_bar->get_node( 'edit-profile' );
		$edit_profile_node->title = str_replace( 'Edit My Profile', 'Profile', $edit_profile_node->title );
		$wp_admin_bar->add_node( $edit_profile_node );
		$logout_node        = $wp_admin_bar->get_node( 'logout' );
		$logout_node->title = str_replace( 'Log Out', 'Logout', $logout_node->title );
		$wp_admin_bar->add_node( $logout_node );*/
		// Remove comments link for everyone except Syntric
		/*if ( ! syn_current_user_can( 'syntric' ) ) {
			$wp_admin_bar->remove_node( 'comments' );
		}*/
		// Move edit/view link to right side of admin bar
		/*if ( is_admin() ) {
			$view_node = $wp_admin_bar->get_node( 'view' );
			if ( $view_node ) {
				$view_node->parent = 'top-secondary';
				$wp_admin_bar->add_node( $view_node );
			}
		} else {
			$edit_node = $wp_admin_bar->get_node( 'edit' );
			if ( $edit_node ) {
				$edit_node->parent = 'top-secondary';
				$wp_admin_bar->add_node( $edit_node );
			}
		}*/
	}

	function syn_new_wp_admin_bar_node( $id, $title, $parent = '', $href = '#', $group = '', $meta = [] ) {
		$wpab_node         = new stdClass();
		$wpab_node->id     = $id;
		$wpab_node->title  = $title;
		$wpab_node->parent = $parent;
		$wpab_node->href   = $href;
		$wpab_node->group  = $group;
		$wpab_node->meta   = $meta;

		return $wpab_node;
	}

	/**
	 * All admin menu customizations
	 *
	 * This must return true in order for the "menu_order" filter to work
	 */
	add_filter( 'custom_menu_order', 'syn_custom_menu_order' );
	function syn_custom_menu_order( $menu_order ) {
		return true;
	}

	/**
	 * Customize the admin menu order and submenus
	 */
	add_filter( 'menu_order', 'syn_menu_order' );
	function syn_menu_order( $menu_order ) {
		//global $submenu;
		$_menu_order = [
			// Dashboard
			'index.php',
			// Pages
			'edit.php?post_type=page',
			'nestedpages', // Pages (Nested Pages)
			// Posts
			'edit.php',
			// School or District or COE or Organization
			'syntric-organization',
			// Calendars
			'edit.php?post_type=syn_calendar',
			// Jumbotrons
			'syntric-jumbotrons',
			// Google Maps
			'syntric-google-maps',
			// Links
			'link-manager.php',
			// Comments
			'edit-comments.php',
			// Media
			'upload.php',
			// Social Media
			'syntric-social-media',
			// Templates
			'edit.php?post_type=tinymcetemplates',
			// Users
			'users.php',
			// Profile
			'profile.php',
			// Appearance
			'themes.php',
			// Plugins
			'plugins.php',
			// Tools
			'tools.php',
			// Settings
			'options-general.php',
			// Custom Fields
			'edit.php?post_type=acf-field-group',
			// Jetpack
			'jetpack',
		];

		return $_menu_order;
	}

// remove the Welcome to Wordpress dashboard panel
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
// disable default dashboard widgets
	add_action( 'admin_init', 'syn_clear_dashboard' );
	function syn_clear_dashboard() {
		global $wp_meta_boxes;
		global $pagenow;
		if ( is_admin() && 'index.php' == $pagenow ) {
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' ); // is this really in the side?
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		}
	}

// add new dashboard widgets
	add_action( 'wp_dashboard_setup', 'syn_dashboard_setup' );
	function syn_dashboard_setup() {
		// Pending posts and pages
		$pending_pages_title = ( get_field( 'syn_user_is_teacher', 'user_' . get_current_user_id() ) ) ? 'My Pages Pending Approval' : 'Pages Pending Approval';
		//$pending_pages_title = 'Pages Pending Approval';
		add_meta_box( 'pending_pages_dashboard_widget', $pending_pages_title, 'syn_list_pendings', 'dashboard', 'normal', 'core', [ 'post_type' => 'page' ] );
		$pending_posts_title = ( get_field( 'syn_user_is_teacher', 'user_' . get_current_user_id() ) ) ? 'My Posts Pending Approval' : 'Posts Pending Approval';
		//$pending_posts_title = 'Posts Pending Approval';
		add_meta_box( 'pending_posts_dashboard_widget', $pending_posts_title, 'syn_list_pendings', 'dashboard', 'normal', 'core', [ 'post_type' => 'post' ] );
		// Recently published posts and pages
		$recently_published_pages_title = ( get_field( 'syn_user_is_teacher', 'user_' . get_current_user_id() ) ) ? 'My Recently Published Pages' : 'Recently Published Pages';
		//$recently_published_pages_title = 'Recently Published Pages';
		add_meta_box( 'recently_published_pages_dashboard_widget', $recently_published_pages_title, 'syn_list_recently_published', 'dashboard', 'normal', 'core', [ 'post_type' => 'page' ] );
		$recently_published_posts_title = ( get_field( 'syn_user_is_teacher', 'user_' . get_current_user_id() ) ) ? 'My Recently Published Posts' : 'Recently Published Posts';
		//$recently_published_posts_title = 'Recently Published Posts';
		add_meta_box( 'recently_published_posts_dashboard_widget', $recently_published_posts_title, 'syn_list_recently_published', 'dashboard', 'normal', 'core', [ 'post_type' => 'post' ] );
		// Classes
		if ( syn_organization_is_school() ) {
			$class_list_title = ( get_field( 'syn_user_is_teacher', 'user_' . get_current_user_id() ) ) ? 'My Classes' : 'Teachers + Classes';
			//$class_list_title = 'Teachers + Classes';
			add_meta_box( 'class_list_dashboard_widget', $class_list_title, 'syn_list_classes', 'dashboard', 'normal', 'core' );
		}
	}

	add_action( 'wp_login', 'syn_login', 10, 2 );
	function syn_login( $user_login, $user ) {
		syn_reset_user_meta_boxes( $user->ID );
	}

	add_filter( 'screen_layout_columns', 'syn_screen_layout_columns' );
	function syn_screen_layout_columns( $columns ) {
		$columns[ 'dashboard' ] = 2;

		return $columns;
	}

	add_filter( 'get_user_option_screen_layout_dashboard', 'syn_layout_dashboard' );
	function syn_layout_dashboard() {
		return 1;
	}

	function syn_reset_user_meta_boxes( $user_id = 0 ) {
		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}
		$user_options = get_user_meta( $user_id );
		foreach ( $user_options as $key => $value ) {
			$cuo_array = explode( '-', $key );
			if ( 'meta' == $cuo_array[ 0 ] && 'box' == $cuo_array[ 1 ] ) {
				if ( isset( $cuo_array[ 2 ] ) ) {
					$cuo_array_2 = explode( '_', $cuo_array[ 2 ] );
					if ( 'order' == $cuo_array_2[ 0 ] ) {
						$res = delete_user_meta( $user_id, $key );
					}
				}
			}
		}
	}

	/**
	 * Show/hide meta boxes
	 */
	add_filter( 'default_hidden_meta_boxes', 'syn_hidden_meta_boxes', 10, 2 );
	function syn_hidden_meta_boxes( $hidden, $screen ) {
		if ( is_admin() ) {
			// hide from everyone...
			$hidden[] = 'postexcerpt'; // Post Excerpts
			$hidden[] = 'trackbacksdiv'; // Send Trackbacks
			$hidden[] = 'postcustom'; // Custom Fields
			$hidden[] = 'commentstatusdiv'; // Discussion
			$hidden[] = 'commentsdiv'; // Comments - Add comment
			$hidden[] = 'slugdiv'; // Slug
			$hidden[] = 'authordiv'; // Author
			//$hidden[] = 'postimagediv'; // Featured Image
			$hidden[] = 'formatdiv'; // Post Format (for themes that use Post Format)
			$hidden[] = 'categorydiv'; // Categories
			$hidden[] = 'microblogdiv'; // Microblogs
			$hidden[] = 'revisionsdiv'; // Revisions
			$hidden[] = 'tagsdiv-microblog'; // Tags
			// hide from everyone but administrator and editor
			if ( ! syn_current_user_can( 'administrator' ) && ! syn_current_user_can( 'editor' ) ) {
				$hidden[] = 'pageparentdiv'; // Page Attributes
				$hidden[] = 'acf-group_59c5d19611678'; // Class page settings
				$hidden[] = 'acf-group_59c5d0f68dd2f'; // Teacher page settings
				//$hidden[] = 'submitdiv'; // Publish
			}
		}

		return $hidden;
	}

	add_filter( 'logout_redirect', 'syn_logout_redirect', 20, 3 );
	function syn_logout_redirect( $redirect_to, $request, $user ) {
		return home_url();
	}

	/*************************************** After footer (after all scripts are loaded) *****************************************/
	/**
	 * Print inline javascript to trigger asyncronous API calls last.
	 * todo: change this so timing of calls are optimized for optimized page rendering
	 */
	add_action( 'wp_print_footer_scripts', 'syn_print_after_footer', 99 );
	function syn_print_after_footer() {
		// todo: rather than just looking for maps, look to see if there is an active map widget...or put call in widget itself.
		// todo: convert this inline javascript to <script async src... to speed rendering
		$maps = get_field( 'syn_google_maps', 'option' );
		if ( 'syn_calendar' == get_post_type() || $maps ) :
			$lb  = "\n";
			$tab = "\t";
			echo '<script type="text/javascript">' . $lb;
			echo $tab . '(function ($) {' . $lb;
			if ( 'syn_calendar' == get_post_type() ) :
				echo $tab . $tab . 'fetchCalendar(' . get_the_ID() . ');' . $lb;
			endif;
			if ( $maps ) :
				echo $tab . $tab . 'fetchMaps();' . $lb;
			endif;
			echo $tab . '})(jQuery);' . $lb;
			echo '</script>' . $lb;
		endif;
	}

	function syn_get_meta_boxes( $screen = null, $context = 'advanced' ) {
		global $wp_meta_boxes;
		if ( empty( $screen ) ) {
			$screen = get_current_screen();
		} elseif ( is_string( $screen ) ) {
			$screen = convert_to_screen( $screen );
		}
		$page = $screen->id;

// todo: remove the logging
		return $wp_meta_boxes[ $page ][ $context ];
	}

	function syn_get_academic_years( $count = 1 ) {
		$ayto_month               = get_field( 'syn_academic_year_turnover_month', 'option' );
		$ayto_date                = get_field( 'syn_academic_year_turnover_date', 'option' );
		$now                      = date_create();
		$current_year             = date_format( $now, 'Y' );
		$current_year_ayto_string = $current_year . '-' . $ayto_month . '-' . $ayto_date;
		$current_year_ayto_date   = date_create( $current_year_ayto_string );
		$start_year               = ( $now > $current_year_ayto_date ) ? $current_year : $current_year - 1;
		//$end_year = $start_year + $count;
		$academic_years = [];
		for ( $i = 1; $i < $count; $i ++ ) {
			$academic_years[] = ( $start_year + $i - 1 ) . '-' . ( $start_year + $i );
		}

		return $academic_years;
	}

	function syn_get_terms() {
		$term_type       = get_field( 'syn_term_type', 'option' );
		$summer_sessions = get_field( 'syn_summer_sessions', 'option' );
		$academic_years  = syn_get_academic_years( 2 );
		$terms           = [];
		foreach ( $academic_years as $academic_year ) {
			$terms[] = [
				'term_id' => $academic_year . ' All Year',
				'term'    => $academic_year . ' - All Year',
			];
			switch ( $term_type ) {
				case 'semester' :
					$terms[] = [
						'term_id' => $academic_year . ' 1st Semester',
						'term'    => $academic_year . ' - 1st Semester',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 2nd Semester',
						'term'    => $academic_year . ' - 2nd Semester',
					];
					break;
				case 'trimester' :
					$terms[] = [
						'term_id' => $academic_year . ' 1st Trimester',
						'term'    => $academic_year . ' - 1st Trimester',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 2nd Trimester',
						'term'    => $academic_year . ' - 2nd Trimester',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 3rd Trimester',
						'term'    => $academic_year . ' - 3rd Trimester',
					];
					break;
				case 'quarter' :
					$terms[] = [
						'term_id' => $academic_year . ' 1st Quarter',
						'term'    => $academic_year . ' - 1st Quarter',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 2nd Quarter',
						'term'    => $academic_year . ' - 2nd Quarter',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 3rd Quarter',
						'term'    => $academic_year . ' - 3rd Quarter',
					];
					$terms[] = [
						'term_id' => $academic_year . ' 4th Quarter',
						'term'    => $academic_year . ' - 4th Quarter',
					];
					break;
			}
			if ( $summer_sessions ) {
				$terms[] = [
					'term_id' => $academic_year . ' Summer Session',
					'term'    => $academic_year . ' - Summer Session',
				];
			}
		}

		return $terms;
	}

	/*************************************** Course *****************************************/
	function syn_get_course( $course_id ) {
		$courses = get_field( 'syn_courses', 'option' );
		if ( $courses ) {
			foreach ( $courses as $course ) {
				if ( $course_id == $course[ 'course_id' ] ) {
					return $course;
				}
			}
		}

		return false;
	}

	function syn_get_courses() {
		$ret                = [];
		$courses            = get_field( 'syn_courses', 'option' );
		$departments_active = get_field( 'syn_departments_active', 'option' );
		if ( $departments_active ) {
			$departments = get_field( 'syn_departments', 'option' );
			$departments = array_column( $departments, 'department', 'department_id' );
		}
		if ( $courses ) {
			foreach ( $courses as $course ) {
				if ( $departments_active ) {
					$course_department = $departments[ $course[ 'department' ] ];
					if ( ! isset( $ret[ $course_department ] ) ) {
						$ret[ $course_department ] = [];
					}
					$ret[ $course_department ][ $course[ 'course_id' ] ] = $course[ 'course' ];
				} else {
					$ret[ $course[ 'course_id' ] ] = $course[ 'course' ];
				}
			}
		}
		if ( ! $departments_active ) {
			asort( $ret );
		}

		return $ret;
	}

	function syn_get_course_teachers( $course_id ) {
		$teacher_pages = syn_get_teacher_pages();
		$teachers      = [];
		$teacher_ids   = [];
		if ( $teacher_pages ) {
			foreach ( $teacher_pages as $teacher_page ) {
				if ( have_rows( 'syn_classes', $teacher_page->ID ) ) {
					while( have_rows( 'syn_classes', $teacher_page->ID ) ) : the_row();
						$course = get_sub_field( 'course', false );
						if ( $course_id == $course ) {
							$teacher_id = get_field( 'syn_page_teacher', $teacher_page->ID );
							if ( ! in_array( $teacher_id, $teacher_ids ) ) {
								$teacher               = syn_get_teacher( $teacher_id );
								$teacher->teacher_page = $teacher_page;
								$teachers[]            = $teacher;
								$teacher_ids[]         = $teacher_id;
							}
						}
					endwhile;
				}
			}
		}

		return $teachers;
	}

	/*************************************** Teachers (page template) Page *****************************************/
// todo: Look at this...was only getting published pages, quickly changed to all...is that correct?
	function syn_get_teachers_page() {
		$post_args = [
			'numberposts'  => - 1,
			'post_type'    => 'page',
			'post_status'  => [
				'publish',
				'draft',
				'future',
				'pending',
				'private',
			],
			'meta_key'     => '_wp_page_template',
			'meta_value'   => 'page-templates/teachers.php',
			'meta_compare' => '=',
		];
		$posts     = get_posts( $post_args );
		if ( 0 == count( $posts ) ) {
			// create and return a new teachers page
			$post_id = syn_create_teachers_page();
			$post    = get_post( $post_id, OBJECT );

			return $post;
		} elseif ( 1 < count( $posts ) ) {
			// Children test
			// ...more than one teachers pages exist...determine which takes precedence, migrate children, trash extras, return winner
			$has_children       = [];
			$has_not_children   = [];
			$post_children_args = [
				'numberposts' => - 1,
				'post_status' => [
					'publish',
					'draft',
					'future',
					'pending',
					'private',
				],
				'post_parent' => 0,
				// change for each iteration
			];
			foreach ( $posts as $post ) {
				$post_children_args[ 'post_parent' ] = $post->ID;
				$post_children                       = get_posts( $post_children_args );
				if ( count( $post_children ) ) {
					$has_children[] = $post;
				} else {
					$has_not_children[] = $post;
				}
			}
			if ( 1 == count( $has_children ) ) {
				if ( count( $has_not_children ) ) {
					syn_trash_pages( $has_not_children );
				}

				return $has_children[ 0 ];
			}
			// Published test
			// ...if only one post_status is published, return it
			$is_published     = [];
			$is_not_published = [];
			foreach ( $posts as $post ) {
				if ( 'publish' == $post->post_status ) {
					$is_published[] = $post;
				} else {
					$is_not_published[] = $post;
				}
			}
			if ( 1 == count( $is_published ) ) {
				if ( count( $is_not_published ) ) {
					syn_trash_pages( $is_not_published );
				}

				return $is_published[ 0 ];
			}
			// ran out of tests...will return first teachers page
			// todo: should send an error or notice that there are more than one teachers pages
		}

		return $posts[ 0 ];
	}

	function syn_create_teachers_page() {
		$academics_page    = get_page_by_title( 'Academics' );
		$academics_page_id = ( $academics_page instanceof WP_Post ) ? $academics_page->ID : 0;
		$args              = [
			'post_type'   => 'page',
			'post_title'  => 'Teachers',
			'post_name'   => 'teachers',
			'post_author' => get_current_user_id(),
			'post_parent' => $academics_page_id,
			'post_status' => 'publish',
		];
		$teachers_page_id  = wp_insert_post( $args );
		update_post_meta( $teachers_page_id, '_wp_page_template', 'page-templates/teachers.php' );

		return $teachers_page_id;
	}

	function syn_update_teachers_page( $post_id ) {
		$post_id       = syn_resolve_post_id( $post_id );
		$teachers_page = get_post( $post_id, OBJECT );
		if ( $teachers_page instanceof WP_Post ) {
			$args             = [
				'ID'         => $post_id,
				'post_title' => 'Teachers',
				'post_name'  => 'teachers',
			];
			$teachers_page_id = wp_update_post( $args );
			update_post_meta( $teachers_page_id, '_wp_page_template', 'page-templates/teachers.php' );

			return $teachers_page_id;
		}

		return false;
	}

	/*************************************** Teacher *****************************************/
	function syn_get_teacher( $user_id ) {
		if ( ! isset( $user_id ) || ! is_numeric( $user_id ) ) {
			return false;
		}
		$user = get_user_by( 'ID', $user_id );
		if ( $user ) {
			$is_teacher = get_user_meta( $user->ID, 'syn_user_is_teacher' );
			if ( $is_teacher ) {
				return $user;
			}
		}

		return 0;
	}

	/*************************************** Teacher Page *****************************************/
	function syn_get_teacher_page( $teacher_id, $include_trash = false ) {
		$post_statuses = [
			'publish',
			'draft',
			'future',
			'pending',
			'private',
		];
		if ( $include_trash ) {
			$post_statuses[] = 'trash';
		}
		$post_args = [
			'numberposts' => - 1,
			'post_type'   => 'page',
			'post_status' => $post_statuses,
			'meta_query'  => [
				[
					'key'     => 'syn_page_teacher',
					'value'   => $teacher_id,
					'compare' => '=',
				],
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-templates/teacher.php',
					'compare' => '=',
				],
			],
		];
		$posts     = get_posts( $post_args );
		if ( 1 == count( $posts ) ) {
			return $posts[ 0 ];
		} elseif ( 1 < count( $posts ) ) {
			return $posts;
		}

		return;
	}

	function syn_do_teacher_page( $user_id ) {
		$user = get_user_by( 'ID', $user_id );
		// get user roles
		$roles = $user->roles;
		// if there are more than one role, remove all but the last in the roles array then set the user role variable
		if ( 1 < count( $roles ) ) {
			$last_role = $roles[ count( $roles ) - 1 ];
			foreach ( $roles as $role ) {
				$user->remove_role( $role );
			}
			$user->set_role( $last_role );
			$role = $last_role;
		} else {
			$role = $roles[ 0 ];
		}
		$is_teacher = get_field( 'syn_user_is_teacher', 'user_' . $user_id );
		if ( $is_teacher ) {
			syn_save_teacher_page( $user_id );
			if ( ! in_array( $role, [ 'author', 'editor', 'administrator', ] ) ) {
				wp_update_user( [ 'ID' => $user_id, 'role' => 'author', ] );
			}
			syn_save_teacher_page( $user_id );
		} else {
			$teacher_page = syn_get_teacher_page( $user_id );
			// If this user is not a teacher but they have a teacher page, their status just changed
			if ( $teacher_page instanceof WP_Post && 'author' == $role ) {
				wp_update_user( [ 'ID' => $user_id, 'role' => 'subscriber' ] );
			}
			syn_trash_teacher_page( $user_id );
		}
	}

	/*function syn_get_teacher_pages() {
		$args = [
			'meta_key' => '_wp_page_template',
			'meta_value' => '/blah.php',
			'post_status' => [ 'publish', 'future', 'draft', 'private', 'pending' ],

		];
	}*/
	function syn_save_teacher_page( $teacher_id ) {
		$teacher = syn_get_teacher( $teacher_id ); // only returns user if is teacher, otherwise false
		if ( $teacher instanceof WP_User ) {
			$teacher_meta  = get_user_meta( $teacher_id );
			$first_name    = $teacher_meta[ 'first_name' ][ 0 ];
			$last_name     = $teacher_meta[ 'last_name' ][ 0 ];
			$post_title    = $first_name . ' ' . $last_name;
			$post_name     = syn_sluggify( $post_title );
			$teachers_page = syn_get_teachers_page(); // Teachers page todo: this function should create the teachers page if it doesn't exist
			if ( $teachers_page instanceof WP_Post ) {// todo: test this...make sure a teachers page is always returned
				$args = [
					'post_type'   => 'page',
					'post_title'  => $post_title,
					'post_name'   => $post_name,
					'post_author' => $teacher_id,
					'post_parent' => $teachers_page->ID,
				];
				// look for existing teacher page, even in the trash
				$teacher_page = syn_get_teacher_page( $teacher_id, true );
				if ( $teacher_page instanceof WP_Post ) {
					$args[ 'ID' ]           = $teacher_page->ID;
					$args[ 'post_content' ] = $teacher_page->post_content;
					$args[ 'post_status' ]  = ( 'trash' != $teacher_page->post_status ) ? $teacher_page->post_status : 'draft';
					$teacher_page_id        = wp_update_post( $args );
				} else {
					$args[ 'post_content' ] = syn_get_teacher_page_content();
					$args[ 'post_status' ]  = 'draft';
					$teacher_page_id        = wp_insert_post( $args );
				}
				update_field( 'syn_user_page', $teacher_page_id, 'user_' . $teacher_id );
				update_post_meta( $teacher_page_id, '_wp_page_template', 'page-templates/teacher.php' );
				update_field( 'syn_page_teacher', $teacher_id, $teacher_page_id );
				update_field( 'syn_contact_active', 1, $teacher_page_id );
				update_field( 'syn_contact_title', 'Contact Teacher', $teacher_page_id );
				update_field( 'syn_contact_contact_type', 'person', $teacher_page_id );
				update_field( 'syn_contact_person', $teacher_id, $teacher_page_id );
				update_field( 'syn_contact_include_person_fields', [
					'prefix',
					'first_name',
					'title',
					'email',
					'phone',
				], $teacher_page_id );

				return $teacher_page_id;
			}
		}

		return;
	}

	function syn_get_teacher_page_content() {
		return '';
		/*return '<h2>Bio</h2>
<p>Write a bio about yourself. Consider including:</p>
<ul>
	<li>Birthplace</li>
	<li>Places lived</li>
	<li>Schools attended</li>
	<li>Hobbies</li>
	<li>Family</li>
	<li>Unique or meaningful life experiences</li>
</ul>
<p>Do not list classes.  A list of classes is generated automatically from the Classes entered below.</p>
<p>Do not include contact information. Instead activate and configure the Contact Widget below.</p>';*/
	}

	function syn_trash_teacher_page( $teacher_id ) {
		$teacher_page = syn_get_teacher_page( $teacher_id ); // returns WP_Post object
		if ( $teacher_page instanceof WP_Post ) {
			// Delete all children of the teacher page to be trashed, not just class pages
			$teacher_page_children = get_posts( [
				'numberposts' => - 1,
				'post_status' => [ 'publish', 'draft', 'future', 'pending', 'private' ],
				'post_parent' => $teacher_page->ID,
				'fields'      => 'ID',
			] );
			if ( $teacher_page_children ) {
				foreach ( $teacher_page_children as $teacher_page_child ) {
					wp_delete_post( $teacher_page_child->ID );
				}
			}
			wp_delete_post( $teacher_page->ID );
			update_field( 'syn_user_page', null, 'user_' . $teacher_id );
		}
	}

	/*************************************** Teacher Class *****************************************/
	function syn_get_teacher_class( $teacher_id, $class_id ) {
		if ( $teacher_id && $class_id ) {
			$teacher_page    = syn_get_teacher_page( $teacher_id );
			$teacher_classes = syn_get_teacher_classes( $teacher_page->ID );
			if ( $teacher_classes ) {
				foreach ( $teacher_classes as $teacher_class ) {
					if ( $class_id == $teacher_class[ 'class_id' ] ) {
						return $teacher_class;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Get a teacher's class page
	 *
	 * @param $teacher_id (int) required - the user ID for the teacher
	 * @param $class_id   (int) required - the ID for the class (not the post ID of the class page)
	 *
	 * @return array - array of class pages for teacher with $teacher_id and class with $class_id (expect only 1)
	 */
	function syn_get_teacher_class_page( $teacher_id, $class_id, $include_trash = false ) {
		$post_statuses = [
			'publish',
			'draft',
			'future',
			'pending',
			'private',
		];
		if ( $include_trash ) {
			$post_statuses[] = 'trash';
		}
		$post_args = [
			'numberposts' => - 1,
			'post_type'   => 'page',
			'post_status' => $post_statuses,
			'meta_query'  => [
				[
					'key'     => 'syn_page_class_teacher',
					'value'   => $teacher_id,
					'compare' => '=',
				],
				[
					'key'     => 'syn_page_class',
					'value'   => $class_id,
					'compare' => '=',
				],
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-templates/class.php',
					'compare' => '=',
				],
			],
		];
		$posts     = get_posts( $post_args );
		if ( 1 == count( $posts ) ) {
			return $posts[ 0 ];
		}

		return $posts;
	}

	/*************************************** Teacher Classes *****************************************/
	function syn_get_teacher_classes( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		$classes = get_field( 'syn_classes', $post_id );

		return $classes;
	}

	/**
	 * Get a teacher's class pages
	 *
	 * @param $teacher_id (int) required - the user ID for the teacher
	 *
	 * @return array - returns an array of class page objects (WP_Post)
	 */
	function syn_get_teacher_class_pages( $teacher_id, $include_trash = false ) {
		$post_statuses = [
			'publish',
			'draft',
			'future',
			'pending',
			'private',
		];
		if ( $include_trash ) {
			$post_statuses[] = 'trash';
		}
		$args  = [
			'numberposts' => - 1,
			'post_type'   => 'page',
			'post_status' => $post_statuses,
			'meta_query'  => [
				[
					'key'     => 'syn_page_class_teacher',
					'value'   => $teacher_id,
					'compare' => '=',
				],
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-templates/class.php',
					'compare' => '=',
				],
			],
		];
		$posts = get_posts( $args );

		return $posts;
	}

	function syn_save_teacher_classes( $teacher_id ) {
		$teacher_page = syn_get_teacher_page( $teacher_id );
		if ( $teacher_page instanceof WP_Post ) {
			$teacher_class_pages = syn_get_teacher_class_pages( $teacher_id, true );
			$tcp_ids             = [];
			$tcp_pages           = [];
			if ( $teacher_class_pages ) {
				foreach ( $teacher_class_pages as $teacher_class_page ) {
					$class_id               = get_field( 'syn_page_class', $teacher_class_page->ID );
					$tcp_ids[]              = $class_id;
					$tcp_pages[ $class_id ] = $teacher_class_page;
				}
			}
			$teacher_classes = syn_get_teacher_classes( $teacher_page->ID );
			$tc_ids          = [];
			$tc_args         = [];
			if ( $teacher_classes ) {
				$departments_active = get_field( 'syn_departments_active', 'option' );
				$courses            = get_field( 'syn_courses', 'option' );
				$courses            = array_column( $courses, 'course', 'course_id' );
				if ( $teacher_classes ) {
					foreach ( $teacher_classes as $teacher_class ) {
						$include_page = $teacher_class[ 'include_page' ];
						if ( $include_page ) {
							$tc_ids[] = $teacher_class[ 'class_id' ];
							$cp_title = ( $departments_active ) ? $courses[ $teacher_class[ 'course' ] ] : $teacher_class[ 'course' ];
							//$cp_title                                = $courses[ $teacher_class[ 'course' ] ];
							$tc_args[ $teacher_class[ 'class_id' ] ] = [
								'post_type'   => 'page',
								'post_title'  => $cp_title,
								'post_name'   => syn_sluggify( $cp_title ),
								'post_author' => $teacher_id,
								'post_parent' => $teacher_page->ID,
							];
						}
					}
				}
				// does - classes that have a page
				$does = array_intersect( $tc_ids, $tcp_ids );
				if ( count( $does ) ) {
					foreach ( $does as $class_id ) {
						$args                   = $tc_args[ $class_id ];
						$tcp                    = $tcp_pages[ $class_id ];
						$args[ 'ID' ]           = $tcp->ID;
						$args[ 'post_status' ]  = ( 'trash' == $tcp->post_status ) ? 'draft' : $tcp->post_status;
						$args[ 'post_content' ] = $tcp->post_content;
						$tcp_id                 = wp_update_post( $args );
						update_post_meta( $tcp_id, '_wp_page_template', 'page-templates/class.php' );
						update_field( 'syn_page_class_teacher', $teacher_id, $tcp_id );
						update_field( 'syn_page_class', $class_id, $tcp_id );
						update_field( 'syn_contact_active', 1, $tcp_id );
						update_field( 'syn_contact_title', 'Contact Teacher', $tcp_id );
						update_field( 'syn_contact_contact_type', 'person', $tcp_id );
						update_field( 'syn_contact_person', $teacher_id, $tcp_id );
						update_field( 'syn_contact_include_person_fields', [
							'prefix',
							'first_name',
							'title',
							'email',
							'phone',
						], $tcp_id );
					}
				}
				// should - classes that should have a page, but don't
				$should = array_diff( $tc_ids, $tcp_ids );
				if ( count( $should ) ) {
					foreach ( $should as $class_id ) {
						$args                   = $tc_args[ $class_id ];
						$args[ 'post_status' ]  = 'draft';
						$args[ 'post_content' ] = syn_get_class_page_content();
						$tcp_id                 = wp_insert_post( $args );
						update_post_meta( $tcp_id, '_wp_page_template', 'page-templates/class.php' );
						update_field( 'syn_page_class_teacher', $teacher_id, $tcp_id );
						update_field( 'syn_page_class', $class_id, $tcp_id );
						update_field( 'syn_contact_active', 1, $tcp_id );
						update_field( 'syn_contact_title', 'Contact Teacher', $tcp_id );
						update_field( 'syn_contact_contact_type', 'person', $tcp_id );
						update_field( 'syn_contact_person', $teacher_id, $tcp_id );
						update_field( 'syn_contact_include_person_fields', [
							'prefix',
							'first_name',
							'title',
							'email',
							'phone',
						], $tcp_id );
					}
				}
				// should_not - classes that have a page but shouldn't
				$should_not = array_diff( $tcp_ids, $tc_ids );
				if ( count( $should_not ) ) {
					foreach ( $should_not as $class_id ) {
						$del_res = syn_trash_teacher_class_page( $teacher_id, $class_id );
					}
				}
			}
		}

		return;
	}

	/**
	 * Trash a teacher's class page
	 *
	 * @param $teacher_id (int) required - the user ID for the teacher
	 * @param $class_id   (int) required - the ID for the class (not the post ID of the class page)
	 */
	function syn_trash_teacher_class_page( $teacher_id, $class_id ) {
		$class_page = syn_get_teacher_class_page( $teacher_id, $class_id );
		if ( $class_page instanceof WP_Post ) {
			$del_res = wp_delete_post( $class_page->ID );

			return $del_res;
		}

		return false;
	}

	/**
	 * Trash all of a teacher's class pages
	 *
	 * @param $teacher_id (int) required - the user ID of the teacher who owns the class pages
	 *
	 * @return array|bool - array of the wp_delete_post results, one for each class page, false if no classes or error
	 */
	function syn_trash_teacher_class_pages( $teacher_id ) {
		$class_pages = syn_get_teacher_class_pages( $teacher_id );
		if ( $class_pages ) {
			$del_res_arr = [];
			foreach ( $class_pages as $class_page ) {
				$del_res                        = wp_delete_post( $class_page->ID );
				$del_res_arr[ $class_page->ID ] = $del_res;
			}

			return $del_res_arr;
		}

		return false;
	}

	function syn_get_class_page_content() {
		return '';
		/*return '<h2>Overview</h2>
<p>Write an overview of the class. Consider including:</p>
<ul>
	<li>Major topics</li>
	<li>Prequisites</li>
	<li>Classes that require this class as a prerequisite</li>
	<li>Grading policy</li>
</ul>';*/
	}

	/*************************************** Teachers *****************************************/
	function syn_get_teachers() {
		$teachers = get_users( [
			'meta_key'   => 'last_name',
			'meta_query' => [
				[
					'key'   => 'syn_user_is_teacher',
					'value' => 1,
				],
			],
			'orderby'    => 'meta_value',
		] );

		return $teachers;
	}

	/*************************************** Teachers Pages *****************************************/
	function syn_get_teacher_pages( $include_trash = false ) {
		$post_statuses = [
			'publish',
			'draft',
			'future',
			'pending',
			'private',
		];
		if ( $include_trash ) {
			$post_statuses[] = 'trash';
		}
		$post_args = [
			'numberposts' => - 1,
			'post_type'   => 'page',
			'post_status' => $post_statuses,
			'meta_query'  => [
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-templates/teacher.php',
					'compare' => '=',
				],
			],
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
		];
		$posts     = get_posts( $post_args );

		return $posts;
	}

	/*************************************** Teachers Classes *****************************************/
	function syn_get_teachers_classes() {
		$teacher_pages = syn_get_teacher_pages();
		$classes       = [];
		foreach ( $teacher_pages as $teacher_page ) {
			$teacher_classes = syn_get_teacher_classes( $teacher_page->ID );
			$classes         = array_merge( $classes, $teacher_classes );
		}

		return $classes;
	}

	function syn_get_teachers_class_pages( $include_trash = false ) {
		$teachers    = syn_get_teachers();
		$teacher_ids = [];
		if ( $teachers ) {
			foreach ( $teachers as $teacher ) {
				$teacher_ids[] = $teacher->ID;
			}
		}
		$post_statuses = [
			'publish',
			'draft',
			'future',
			'pending',
			'private',
		];
		if ( $include_trash ) {
			$post_statuses[] = 'trash';
		}
		$args  = [
			'numberposts' => - 1,
			'post_type'   => 'page',
			'post_status' => $post_statuses,
			'meta_query'  => [
				[
					'key'     => 'syn_page_class_teacher',
					'value'   => $teacher_ids,
					'compare' => 'in',
				],
				[
					'key'     => '_wp_page_template',
					'value'   => 'page-templates/class.php',
					'compare' => '=',
				],
			],
		];
		$posts = get_posts( $args );

		return $posts;
	}

	/*************************************** Organization(s) *****************************************/
	function syn_get_organization() {
		$organization = get_field( 'syn_organization', 'option' );
		if ( $organization ) {
			$org                        = [];
			$org[ 'organization_id' ]   = get_field( 'syn_organization_id', 'option' );
			$org[ 'organization' ]      = $organization;
			$org[ 'organization_type' ] = get_field( 'syn_organization_type', 'option' );
			$org[ 'address' ]           = get_field( 'syn_organization_address', 'option' );
			$org[ 'address_2' ]         = get_field( 'syn_organization_address_2', 'option' );
			$org[ 'city' ]              = get_field( 'syn_organization_city', 'option' );
			$org[ 'state' ]             = get_field( 'syn_organization_state', 'option' );
			$org[ 'zip_code' ]          = get_field( 'syn_organization_zip_code', 'option' );
			$org[ 'email' ]             = get_field( 'syn_organization_email', 'option' );
			$org[ 'url' ]               = get_field( 'syn_organization_url', 'option' );
			$org[ 'phone' ]             = get_field( 'syn_organization_phone', 'option' );
			$org[ 'extension' ]         = get_field( 'syn_organization_extension', 'option' );
			$org[ 'fax' ]               = get_field( 'syn_organization_fax', 'option' );
			$org[ 'logo' ]              = get_field( 'syn_organization_logo', 'option' );

			return $org;
		}

		return false;
	}

	function syn_get_organization_type_label() {
		$org_type       = syn_get_organization_type();
		$org_type_array = explode( '_', $org_type );
		if ( 'school_district' == $org_type ) {
			return 'District';
		} elseif ( 'coe' == $org_type ) {
			return 'COE';
		} elseif ( 'school' == $org_type_array[ count( $org_type_array ) - 1 ] ) {
			return 'School';
		} else {
			return 'Organization';
		}
	}

	function syn_get_organizations_type_label() {
		$org_type       = syn_get_organization_type();
		$org_type_array = explode( '_', $org_type );
		if ( 'school_district' == $org_type ) {
			return 'Schools';
		} elseif ( 'coe' == $org_type ) {
			return 'Districts';
		} elseif ( 'school' == $org_type_array[ count( $org_type_array ) - 1 ] ) {
			return 'Organizations';
		} else {
			return 'Organizations';
		}
	}

	function syn_get_organization_type() {
		$organization = syn_get_organization();
		if ( ! $organization ) {
			return 'other';
		} else {
			return $organization[ 'organization_type' ][ 'value' ];
		}
	}

	function syn_organization_is_school() {
		$organization_type = syn_get_organization_type();
		$school_types      = [
			'elementary_school',
			'primary_school',
			'secondary_school',
			'adult_ed_school',
			'adult_education_school',
			'alterative_school',
			'school',
			'high_school',
			'middle_school',
			'jr_high_school',
		];
		if ( in_array( $organization_type, $school_types ) ) {
			return true;
		}

		return false;
	}

	function syn_trash_pages( $posts ) {
		if ( is_array( $posts ) ) {
			foreach ( $posts as $post ) {
				if ( $post instanceof WP_Post ) {
					wp_delete_post( $post->ID, false );
				} else {
					wp_delete_post( $post[ 'ID' ] );
				}
			}

			return true;
		} elseif ( $posts instanceof WP_Post ) {
			wp_delete_post( $posts->ID );

			return true;
		} elseif ( is_int( $posts ) ) {
			wp_delete_post( $posts );

			return true;
		}

		return false;
	}

	/**
	 * Get a page template
	 *
	 * @param $post_id
	 *
	 * @return bool
	 */
	function syn_get_page_template( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'page' == get_post_type( $post_id ) ) {
			$page_meta = get_post_meta( $post_id );
			if ( isset( $page_meta[ '_wp_page_template' ] ) ) {
				$page_template_path     = $page_meta[ '_wp_page_template' ];
				$page_template_path_arr = explode( '/', $page_template_path[ 0 ] );
				$page_template_file     = $page_template_path_arr[ count( $page_template_path_arr ) - 1 ];
				$page_template_file_arr = explode( '.', $page_template_file );
				$page_template          = $page_template_file_arr[ 0 ];

				return $page_template;
			}

			return 'default';
		}

		return false;
	}

	function syn_is_default_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'page' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_is_teachers_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'teachers' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_is_teacher_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'teacher' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_is_class_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'class' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_is_course_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'course' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_is_department_page( $post_id ) {
		$post_id = syn_resolve_post_id( $post_id );
		if ( 'department' == syn_get_page_template( $post_id ) ) {
			return true;
		}

		return false;
	}

	function syn_sluggify( $string ) {
		$slug = str_replace( ' ', '-', $string );
		$slug = preg_replace( "/[^A-Za-z0-9\-]/", '', $slug );
		$slug = str_replace( '--', '-', $slug );
		$slug = str_replace( '---', '-', $slug );

		return strtolower( $slug );
	}

	function syn_header() {
		$lb  = syn_get_linebreak();
		$tab = syn_get_tab();
		echo '<div id="fb-root"></div>';
		echo '<div class="print-header print-header-name d-print-block" aria-hidden="true">' . get_bloginfo( 'name', 'display' ) . '</div>' . $lb;
		echo '<a class="sr-only sr-only-focusable skip-to-content-link" href="#content">' . esc_html( 'Skip to content', 'syntric' ) . '</a>' . $lb;
		if ( 'school_district' == syn_get_organization_type() ) {
			echo '<header class="head">' . $lb;
			echo $tab . '<div class="container-fluid">' . $lb;
			echo $tab . $tab . '<div class="row">' . $lb;
			echo $tab . $tab . $tab . '<div class="col">' . $lb;
			echo $tab . $tab . $tab . $tab . '<nav class="portal-links" aria-label="Portal links">' . $lb;
			echo $tab . $tab . $tab . $tab . $tab . '<a href="https://amadorcusd.asp.aeries.net/teacher/Login.aspx?page=default.aspx" class="teacher-portal" target="_blank">Teacher Portal <span class="fa fa-sign-in"></span></a>' . $lb;
			echo $tab . $tab . $tab . $tab . $tab . '<a href="https://amadorcusd.asp.aeries.net/student/LoginParent.aspx?page=default.aspx" class="parent-portal" target="_blank">Parent Portal <span class="fa fa-sign-in"></span></a>' . $lb;
			echo $tab . $tab . $tab . $tab . '</nav>' . $lb;
			echo $tab . $tab . $tab . '</div>' . $lb;
			echo $tab . $tab . '</div>' . $lb;
			echo $tab . '</div>' . $lb;
			echo '</header>' . $lb;
		}
		syn_primary_nav();
		get_search_form();
		syn_banner();
		syn_breadcrumbs();
		syn_sidebar( 'header' );
	}

	function syn_banner() {
		global $post;
		// todo: come back and fix this...kinda clunky
		if ( has_header_image() ) {
			$header_image           = get_header_image();
			$banner_style_attribute = ' style="background-image: url(' . $header_image . ');" ';
		} else {
			$banner_style_attribute = ' style="min-height: 0;" ';
		}
		$jumbotrons = get_field( 'syn_jumbotrons', 'option' );
		if ( has_header_image() || $jumbotrons ) {
			$lb  = syn_get_linebreak();
			$tab = syn_get_tab();
			echo '<div class="banner-wrapper" aria-hidden="true"' . $banner_style_attribute . 'role="banner">' . $lb;
			echo syn_jumbotron();
			echo '</div>' . $lb;
		}
	}

	function syn_jumbotron() {
		global $post;
		if ( ! $post ) {
			return;
		}
		$jumbotrons = get_field( 'syn_jumbotrons', 'option' );
		if ( 0 < count( $jumbotrons ) ) {
			$jumbotron = false;
			foreach ( $jumbotrons as $_jumbotron ) {
				$filters        = $_jumbotron[ 'filters' ];
				$start_datetime = $_jumbotron[ 'start_datetime' ];
				$end_datetime   = $_jumbotron[ 'end_datetime' ];
				$pass_filters   = ( 0 < count( $filters ) ) ? syn_process_filters( $filters, $post ) : true;
				$pass_schedule  = ( $start_datetime || $end_datetime ) ? syn_process_schedule( $start_datetime, $end_datetime ) : true;
				if ( $pass_filters && $pass_schedule ) {
					$jumbotron = $_jumbotron;
					break;
				}
			}
			if ( $jumbotron ) {
				$lb  = syn_get_linebreak();
				$tab = syn_get_tab();
				echo '<div class="jumbotron-wrapper">' . $lb;
				echo $tab . '<h1 class="jumbotron-headline">' . $jumbotron[ 'headline' ] . '</h1>' . $lb;
				echo $tab . '<div class="jumbotron-caption">' . $jumbotron[ 'caption' ] . '</div>' . $lb;
				if ( $jumbotron[ 'include_button' ] ) {
					$button_href   = ( 'page' == $jumbotron[ 'button_target' ] ) ? $jumbotron[ 'button_page' ] : $jumbotron[ 'button_url' ];
					$window_target = ( 'page' == $jumbotron[ 'button_target' ] ) ? '_self' : '_blank';
					echo $tab . '<a href="' . $button_href . '" class="btn btn-lg btn-primary jumbotron-button" target="' . $window_target . '">' . $jumbotron[ 'button_text' ] . '</a>' . $lb;
				}
				echo '</div>' . $lb;
			}
		}
	}

	function syn_login_form() {
		$args = [
			'echo'           => false,
			'remember'       => true,
			'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ],
			'form_id'        => 'loginform',
			'id_username'    => 'user_login',
			'id_password'    => 'user_pass',
			'id_remember'    => 'rememberme',
			'id_submit'      => 'wp-submit',
			'label_username' => __( 'Username or Email Address' ),
			'label_password' => __( 'Password' ),
			'label_remember' => __( 'Remember Me' ),
			'label_log_in'   => __( 'Log In' ),
			'value_username' => '',
			'value_remember' => false,
		];

		return wp_login_form( $args );
	}

	/**
	 * Outputs a breadcrumb nav based on where one is in the site
	 */
	function syn_breadcrumbs() {
		global $post;
		if ( is_front_page() ) {
			return;
		}
		$breadcrumbs = '<div class="breadcrumb-wrapper">';
		$breadcrumbs .= '<div class="' . esc_html( get_theme_mod( 'syntric_container_type' ) ) . '">';
		$breadcrumbs .= '<nav class="breadcrumb">';
		$breadcrumbs .= '<a class="breadcrumb-item" href="' . home_url() . '">Home</a>';
		if ( is_home() ) {
			$post_type_labels = get_post_type_labels( get_post_type_object( 'post' ) );
			$breadcrumbs      .= '<a class="breadcrumb-item active" href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '">' . esc_html( $post_type_labels->name ) . '</a>';
		}
		if ( is_archive() ) {
			$active = ( is_archive() ) ? ' active' : '';
			if ( 'syn_event' == $post->post_type || 'syn_calendar' == $post->post_type ) {
				$post_type_labels = get_post_type_labels( get_post_type_object( 'syn_calendar' ) );
				$breadcrumbs      .= '<span class="breadcrumb-item">' . esc_html( $post_type_labels->name ) . '</span>';
				$breadcrumbs      .= '<span class="breadcrumb-item' . $active . '">' . esc_html( $post_type_labels->name ) . '</span>';
			} elseif ( 'syn_calendar' == $post->post_type ) {
				$post_type_labels = get_post_type_labels( get_post_type_object( 'syn_calendar' ) );
				$breadcrumbs      .= '<span class="breadcrumb-item' . $active . '">' . esc_html( $post_type_labels->name ) . '</span>';
			} else {
				$categories  = get_the_category( $post->ID );
				$breadcrumbs .= '<a class="breadcrumb-item' . $active . '" href="' . esc_url( get_category_link( $categories[ 0 ]->term_id ) ) . '">' . esc_html( $categories[ 0 ]->name ) . '</a>';
			}
		}
		if ( is_attachment() ) {
			$breadcrumbs .= '<span class="breadcrumb-item active">Attachment</span>';
		}
		if ( is_single() && ! is_attachment() ) { // post, syn_calendar or syn_event
			if ( 'syn_event' == $post->post_type ) {
				$calendar_post_type_labels = get_post_type_labels( get_post_type_object( 'syn_calendar' ) );
				$event_post_type_labels    = get_post_type_labels( get_post_type_object( 'syn_event' ) );
				$event_calendar_id         = get_field( 'syn_event_calendar_id', $post->ID );
				$breadcrumbs               .= '<span class="breadcrumb-item">' . esc_html( $calendar_post_type_labels->name ) . '</span>';
				$breadcrumbs               .= '<a class="breadcrumb-item" href="' . esc_url( get_the_permalink( $event_calendar_id ) ) . '">' . esc_html( get_the_title( $event_calendar_id ) ) . '</a>';
				$breadcrumbs               .= '<span class="breadcrumb-item">' . esc_html( $event_post_type_labels->name ) . '</span>';
			} elseif ( 'syn_calendar' == $post->post_type ) {
				$calendar_post_type_labels = get_post_type_labels( get_post_type_object( 'syn_calendar' ) );
				$breadcrumbs               .= '<span class="breadcrumb-item">' . esc_html( $calendar_post_type_labels->name ) . '</span>';
				//} elseif ( 'attachment' == $post->post_type ) {
				//$attachment = wp_get_attachment_metadata( $post->ID );
				//$breadcrumbs               .= '<span class="breadcrumb-item">Attachment</span>';
			} else {
				$categories  = get_the_category( $post->ID );
				$breadcrumbs .= '<a class="breadcrumb-item active" href="' . esc_url( get_category_link( $categories[ 0 ]->term_id ) ) . '">' . esc_html( $categories[ 0 ]->name ) . '</a>';
			}
			$breadcrumbs .= '<a class="breadcrumb-item active" href="' . esc_url( get_the_permalink( $post->ID ) ) . '">' . esc_html( get_the_title( $post->ID ) ) . '</a>';
		}
		if ( is_page() ) {
			$ancestor_ids = array_reverse( get_post_ancestors( $post->ID ) );
			if ( $ancestor_ids ) {
				foreach ( $ancestor_ids as $ancestor_id ) {
					$ancestor = get_post( $ancestor_id );
					if ( 0 == $ancestor->post_parent ) {
						$breadcrumbs .= '<span class="breadcrumb-item">' . esc_html( $ancestor->post_title ) . '</span>';
					} else {
						$breadcrumbs .= '<a class="breadcrumb-item" href="' . esc_url( get_the_permalink( $ancestor->ID ) ) . '">' . esc_html( $ancestor->post_title ) . '</a>';
					}
				}
			}
			$breadcrumbs .= '<a class="breadcrumb-item active" href="' . esc_url( get_the_permalink( $post->ID ) ) . '">' . esc_html( get_the_title( $post->ID ) ) . '</a>';
		}
		if ( is_search() ) {
			$breadcrumbs .= '<span class="breadcrumb-item active">Search Results</span>';
		}
		if ( is_404() ) {
			$breadcrumbs .= '<span class="breadcrumb-item active">Page Not Found</span>';
		}
		$breadcrumbs .= '</nav>';
		$breadcrumbs .= '</div>';
		$breadcrumbs .= '</div>';
		echo $breadcrumbs;
	}

	/**
	 * Final footer contains elements common to every site and is not intended to
	 * be edited.  It does need to be modified to reflect current site.
	 * todo: move non-discrimination copy into an option. perhaps make translation element toggelable.
	 */
	function syn_foot() {
		$organization = get_field( 'syn_organization', 'option' );
		$lb           = syn_get_linebreak();
		// 11111
		$tab          = syn_get_tab();
		echo '<footer class="foot">' . $lb;
		echo $tab . '<div class="container-fluid">' . $lb;
		echo $tab . $tab . '<div class="row">' . $lb;
		echo $tab . $tab . $tab . '<div class="non-discrimination col">' . $organization . ' does not discriminate on the basis of race, color, national origin, age, religion, political affiliation, gender, mental or physical disability, sexual orientation, parental or marital status, or any other basis protected by federal, state, or local law, ordinance or regulation, in its educational program(s) or employment.</div>' . $lb;
		echo $tab . $tab . '</div>' . $lb;
		echo $tab . $tab . '<div class="row">' . $lb;
		echo $tab . $tab . $tab . '<div class="col">' . $lb;
		//echo $tab . $tab . '<div id="google-translate" class="google-translate"></div>' . $lb;
		echo $tab . $tab . $tab . $tab . '<div class="copyright">&copy; ' . date( 'Y' ) . ' ' . $organization . '</div>' . $lb;
		echo $tab . $tab . $tab . '</div>' . $lb;
		echo $tab . $tab . $tab . '<div class="col">' . $lb;
		echo $tab . $tab . $tab . $tab . '<div class="login-bug">' . $lb;
		if ( is_user_logged_in() ) {
			echo $tab . $tab . $tab . $tab . $tab . '<a href="' . wp_logout_url( get_the_permalink() ) . '" class="btn btn-sm btn-danger login-button">Logout</a>' . $lb;
		} else {
			echo $tab . $tab . $tab . $tab . $tab . '<a href="' . wp_login_url( get_the_permalink() ) . '" class="btn btn-sm btn-danger login-button">Login</a>' . $lb;
		}
		echo $tab . $tab . $tab . $tab . $tab . syn_bug() . $lb;
		echo $tab . $tab . $tab . $tab . '</div>' . $lb;
		echo $tab . $tab . $tab . '</div>' . $lb;
		echo $tab . $tab . '</div>' . $lb;
		echo $tab . '</div>' . $lb;
		echo '</footer>' . $lb;
		syn_comments();
	}

	function syn_comments() {
		//comments_open() &&  && syn_current_user_can( 'editor' )
		if ( syn_is_staging() && is_user_logged_in() ) {
			comments_template();
		}
	}

	function syn_bug() {
		//echo 'Website by <a href="http://www.syntric.com" target="_blank" class="footer-bug">Syntric</a>' . $lb;
		$bug = '';
		$bug .= '<a href="http://www.syntric.com" target="_blank" class="bug">';
		$bug .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/syntric-logo-bug.png" alt="Syntric logo">';
		$bug .= '</a>';

		return $bug;
	}

// front-end lists
	function syn_display_teachers() {
		$teachers = syn_get_teachers();
		if ( $teachers ) {
			$lb  = syn_get_linebreak();
			$tab = syn_get_tab();
			echo '<h2>Teacher Roster</h2>' . $lb;
			echo '<table class="teachers-table">' . $lb;
			echo $tab . '<thead>' . $lb;
			echo $tab . $tab . '<tr>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Name</th>' . $lb;
			//echo $tab . $tab . $tab . '<th scope="col">Title</th>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Email</th>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Phone</th>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Classes</th>' . $lb;
			echo $tab . $tab . '</tr>' . $lb;
			echo $tab . '</thead>' . $lb;
			echo $tab . '<tbody>' . $lb;
			foreach ( $teachers as $teacher ) {
				$display_name = $teacher->display_name;
				$prefix       = get_field( 'syn_user_prefix', 'user_' . $teacher->ID );
				$full_name    = ( ! empty( $prefix ) ) ? $prefix . ' ' . $display_name : $display_name;
				//$title                  = get_field( 'syn_user_title', 'user_' . $teacher->ID );
				$email                  = $teacher->data->user_email;
				$phone                  = get_field( 'syn_user_phone', 'user_' . $teacher->ID );
				$ext                    = get_field( 'syn_user_extension', 'user_' . $teacher->ID );
				$ext                    = ( isset( $ext ) && ! empty( $ext ) && ! empty( $phone ) ) ? ' x' . $ext : '';
				$phone                  = ( ! empty( $phone ) ) ? $phone . $ext : '';
				$teacher_page           = syn_get_teacher_page( $teacher->ID );
				$teacher_page_published = ( $teacher_page && 'publish' == $teacher_page->post_status ) ? true : false;
				$teacher_classes        = ( $teacher_page_published ) ? get_field( 'syn_classes', $teacher_page->ID ) : false;
				$courses                = get_field( 'syn_courses', 'option' );
				if ( $courses ) {
					$courses = array_column( $courses, 'course', 'course_id' );
				} else {
					$courses = [];
				}
				// build a csv list of classes
				$class_array = [];
				if ( $teacher_classes ) {
					foreach ( $teacher_classes as $class ) {
						$class_page = syn_get_teacher_class_page( $teacher->ID, $class[ 'class_id' ] );
						if ( $class_page instanceof WP_Post && 'publish' == $class_page->post_status ) {
							$class_array[] = '<a href="' . get_the_permalink( $class_page->ID ) . '">' . $class_page->post_title . '</a>';
						} else {
							$class_array[] = $courses[ $class[ 'course' ] ];
						}
					}
				}
				echo $tab . $tab . '<tr valign="top">' . $lb;
				echo $tab . $tab . $tab . '<td class="full-name">' . $lb;
				if ( $teacher_page_published ) {
					echo $tab . $tab . $tab . $tab . '<a href="' . get_the_permalink( $teacher_page->ID ) . '">';
				}
				echo $full_name;
				if ( $teacher_page_published ) {
					echo '</a>' . $lb;
				}
				echo $tab . $tab . $tab . '</td>' . $lb;
				echo $tab . $tab . $tab . '<td class="email"><a href="mailto:' . antispambot( $email, true ) . '" class="teachers-list-email" title="Email">' . antispambot( $email ) . '</a></td>' . $lb;
				echo $tab . $tab . $tab . '<td class="phone">' . $phone . '</td>' . $lb;
				echo $tab . $tab . $tab . '<td class="classes">' . implode( ' / ', $class_array ) . '</td>' . $lb;
				echo $tab . $tab . '</tr>' . $lb;
			}
			echo $tab . '</tbody>' . $lb;
			echo '</table>' . $lb;
		}
	}

	function syn_display_teacher_classes() {
		global $post;
		if ( 'page' == $post->post_type ) {
			$teacher_id = get_field( 'syn_page_teacher', $post->ID );
			if ( $teacher_id ) {
				if ( have_rows( 'syn_classes', $post->ID ) ) {
					$terms          = syn_get_terms();
					$terms          = array_column( $terms, 'term', 'term_id' );
					$courses        = get_field( 'syn_courses', 'option' );
					$courses        = array_column( $courses, 'course', 'course_id' );
					$periods_active = get_field( 'syn_periods_active', 'option' );
					if ( $periods_active ) {
						$periods = get_field( 'syn_periods', 'option' );
						$periods = array_column( $periods, 'period', 'period_id' );
					}
					$rooms_active = get_field( 'syn_rooms_active', 'option' );
					if ( $rooms_active ) {
						$rooms = get_field( 'syn_rooms', 'option' );
						$rooms = array_column( $rooms, 'room', 'room_id' );
					}
					$lb  = syn_get_linebreak();
					$tab = syn_get_tab();
					echo '<h2>Classes</h2>' . $lb;
					echo '<table class="teacher-classes-table">' . $lb;
					echo $tab . '<thead>' . $lb;
					echo $tab . $tab . '<tr>' . $lb;
					echo $tab . $tab . $tab . '<th scope="col">Term</th>' . $lb;
					if ( $periods_active ) {
						echo $tab . $tab . $tab . '<th scope="col">Period</th>' . $lb;
					}
					echo $tab . $tab . $tab . '<th scope="col">Course</th>' . $lb;
					if ( $rooms_active ) {
						echo $tab . $tab . $tab . '<th scope="col">Room</th>' . $lb;
					}
					echo $tab . $tab . '</tr>' . $lb;
					echo $tab . '</thead>' . $lb;
					echo $tab . '<tbody>' . $lb;
					while( have_rows( 'syn_classes', $post->ID ) ) : the_row();
						$class_id = get_sub_field( 'class_id' );
						//$include_page = get_sub_field( 'include_page' );
						$page = syn_get_teacher_class_page( $teacher_id, $class_id );
						echo $tab . $tab . '<tr>' . $lb;
						echo $tab . $tab . $tab . '<td class="term">' . $terms[ get_sub_field( 'term' ) ] . '</td>' . $lb;
						if ( $periods_active ) {
							echo $tab . $tab . $tab . '<td class="period">' . $periods[ get_sub_field( 'period' ) ] . '</td>' . $lb;
						}
						echo $tab . $tab . $tab . '<td class="course">' . $lb;
						if ( $page instanceof WP_Post && 'publish' == $page->post_status ) {
							echo $tab . $tab . $tab . $tab . '<a href="' . get_the_permalink( $page->ID ) . '">';
						}
						//echo get_sub_field( 'course', false );
						echo $courses[ get_sub_field( 'course' ) ];
						if ( $page instanceof WP_Post && 'publish' == $page->post_status ) {
							echo '</a>' . $lb;
						}
						echo $tab . $tab . $tab . '</td>' . $lb;
						if ( $rooms_active ) {
							echo $tab . $tab . $tab . '<td class="room">' . $rooms[ get_sub_field( 'room' ) ] . '</td>' . $lb;
						}
						echo $tab . $tab . '</tr>' . $lb;
					endwhile;
					echo $tab . '</tbody>' . $lb;
					echo '</table>' . $lb;
				}
			}
		}
	}

	function syn_display_department_courses() {
		global $post;
		$departments_active = get_field( 'syn_departments_active', 'option' );
		if ( $departments_active ) {
			$department = get_field( 'syn_page_department', $post->ID );
			if ( $department ) {
				$courses = get_field( 'syn_courses', 'option' );
				if ( $courses ) {
					$lb  = syn_get_linebreak();
					$tab = syn_get_tab();
					foreach ( $courses as $key => $row ) {
						$c[ $key ] = $row[ 'course' ];
					}
					array_multisort( $c, SORT_ASC, $courses );
					echo '<h2>Courses</h2>' . $lb;
					echo '<table class="department-courses-table">' . $lb;
					echo $tab . '<thead>' . $lb;
					echo $tab . $tab . '<tr>' . $lb;
					echo $tab . $tab . $tab . '<th scope="col">Course</th>' . $lb;
					echo $tab . $tab . $tab . '<th scope="col">Teachers</th>' . $lb;
					echo $tab . $tab . '</tr>' . $lb;
					echo $tab . '</thead>' . $lb;
					echo $tab . '<tbody>' . $lb;
					foreach ( $courses as $course ) {
						if ( $department == $course[ 'department' ] ) {
							$course_teachers = syn_get_course_teachers( $course[ 'course_id' ] );
							$teachers        = [];
							if ( count( $course_teachers ) ) {
								foreach ( $course_teachers as $course_teacher ) {
									$teacher      = '';
									$display_name = $course_teacher->data->display_name;
									$prefix       = get_field( 'syn_user_prefix', 'user_' . $course_teacher->ID );
									$display_name = ( ! empty( $prefix ) ) ? $prefix . ' ' . $display_name : $display_name;
									$has_page     = ( $course_teacher->data->teacher_page instanceof WP_Post && 'publish' == $course_teacher->data->teacher_page->post_status ) ? 1 : 0;
									if ( $has_page ) {
										$teacher .= '<a href="' . get_the_permalink( $course_teacher->data->teacher_page->ID ) . '">';
										$teacher .= $display_name;
										$teacher .= '</a>';
									} else {
										$teacher .= $display_name;
									}
									$teachers[] = $teacher;
								}
							}
							echo $tab . $tab . '<tr>' . $lb;
							echo $tab . $tab . $tab . '<td>' . $course[ 'course' ] . '</td>' . $lb;
							echo $tab . $tab . $tab . '<td>' . implode( ' / ', $teachers ) . '</td>' . $lb;
							echo $tab . $tab . '</tr>' . $lb;
						}
					}
					echo $tab . '</tbody>' . $lb;
					echo '</table>' . $lb;
				}
			}
		}
	}

	function syn_display_course() {
		global $post;
		$course_id = get_field( 'syn_page_course', $post->ID );
		$course    = syn_get_course( $course_id );
		if ( is_array( $course ) ) {
			echo $course[ 'description' ];
		}
		//if ( $departments_active ) {
		//$department = get_field( 'syn_page_department', $post->ID );
		//if ( $department ) {
		//$courses = get_field( 'syn_courses', 'option' );
		/*if ( $course ) {
			if ( syn_remove_whitespace() ) {
				$lb  = '';
				$tab = '';
			} else {
				$lb  = "\n";
				$tab = "\t";
			}
			foreach ( $courses as $key => $row ) {
				$c[ $key ] = $row[ 'course' ];
			}
			array_multisort( $c, SORT_ASC, $courses );
			echo '<h2>Courses</h2>' . $lb;
			echo '<table class="department-courses-table">' . $lb;
			echo $tab . '<thead>' . $lb;
			echo $tab . $tab . '<tr>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Course</th>' . $lb;
			echo $tab . $tab . $tab . '<th scope="col">Teachers</th>' . $lb;
			echo $tab . $tab . '</tr>' . $lb;
			echo $tab . '</thead>' . $lb;
			echo $tab . '<tbody>' . $lb;
			foreach ( $courses as $course ) {
				if ( $department == $course[ 'department' ] ) {
					$course_teachers = syn_get_course_teachers( $course[ 'course_id' ] );
					$teachers        = [];
					if ( count( $course_teachers ) ) {
						foreach ( $course_teachers as $course_teacher ) {
							$teacher      = '';
							$display_name = $course_teacher->data->display_name;
							$prefix       = get_field( 'syn_user_prefix', 'user_' . $course_teacher->ID );
							$display_name = ( ! empty( $prefix ) ) ? $prefix . ' ' . $display_name : $display_name;
							$has_page     = ( $course_teacher->data->teacher_page instanceof WP_Post && 'publish' == $course_teacher->data->teacher_page->post_status ) ? 1 : 0;
							if ( $has_page ) {
								$teacher .= '<a href="' . get_the_permalink( $course_teacher->data->teacher_page->ID ) . '">';
								$teacher .= $display_name;
								$teacher .= '</a>';
							} else {
								$teacher .= $display_name;
							}
							$teachers[] = $teacher;
						}
					}
					echo $tab . $tab . '<tr>' . $lb;
					echo $tab . $tab . $tab . '<td>' . $course[ 'course' ] . '</td>' . $lb;
					echo $tab . $tab . $tab . '<td>' . implode( ' / ', $teachers ) . '</td>' . $lb;
					echo $tab . $tab . '</tr>' . $lb;
				}
			}
			echo $tab . '</tbody>' . $lb;
			echo '</table>' . $lb;
		}*/
		//}
		//}
	}

// admin/dashboard lists
	function syn_list_pendings( $deprecated, $mb_args ) {
		$user_id    = get_current_user_id();
		$is_teacher = get_field( 'syn_user_is_teacher', 'user_' . $user_id );
		$post_type  = $mb_args[ 'args' ][ 'post_type' ];
		$args       = [
			'numberposts'   => - 1,
			'post_type'     => $post_type,
			'post_status'   => [ 'pending' ],
			//'orderby'       => array( 'menu_order' => 'ASC' ),
			'no_found_rows' => true,
		];
		if ( $is_teacher ) {
			$args[ 'author' ] = $user_id;
		}
		$pendings = get_posts( $args );
		echo '<table class="admin-list">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">Title</th>';
		echo '<th class="status" scope="col">Status</th>';
		if ( 'page' == $post_type ) {
			echo '<th class="template" scope="col" nowrap="nowrap">Template</th>';
		} elseif ( 'post' == $post_type ) {
			echo '<th class="category" scope="col" nowrap="nowrap">Category</th>';
		}
		echo '<th class="owner" scope="col">Author</th>';
		echo '<th class="submitted" scope="col">Submitted</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		if ( $pendings ) {
			foreach ( $pendings as $pending ) {
				echo '<tr>';
				echo '<td nowrap="nowrap">';
				echo '<a href="/wp-admin/post.php?action=edit&post=' . $pending->ID . '">' . $pending->post_title . '</a>';
				echo '</td>';
				echo '<td>' . ucwords( $pending->post_status ) . '</td>';
				if ( 'page' == $pending->post_type ) {
					echo '<td>' . ucwords( syn_get_page_template( $pending->ID ) ) . '</td>';
				} elseif ( 'post' == $pending->post_type ) {
					$categories = get_the_category( $pending->ID );
					$cats       = [];
					foreach ( $categories as $category ) {
						$cats[] = $category->name;
					}
					echo '<td>' . implode( ', ', $cats ) . '</td>';
				}
				echo '<td>' . get_the_author_meta( 'display_name', $pending->post_author ) . '</td>';
				echo '<td>' . syn_get_time_interval( $pending->post_date ) . ' ago</td>';
				echo '</tr>';
			}
		} else {
			echo '<tr>';
			echo '<td colspan="5">No ' . $post_type . 's are pending</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}

	function syn_list_recently_published( $deprecated, $mb_args ) {
		$user_id    = get_current_user_id();
		$is_teacher = get_field( 'syn_user_is_teacher', 'user_' . $user_id );
		$post_type  = $mb_args[ 'args' ][ 'post_type' ];
		$args       = [
			'numberposts'   => 5,
			'post_type'     => $post_type,
			'post_status'   => [ 'publish' ],
			'no_found_rows' => true,
		];
		if ( $is_teacher ) {
			$args[ 'author' ] = $user_id;
		}
		$recents = get_posts( $args );
		echo '<table class="admin-list">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">Title</th>';
		echo '<th class="status" scope="col">Status</th>';
		if ( 'page' == $post_type ) {
			echo '<th class="template" scope="col" nowrap="nowrap">Template</th>';
		} elseif ( 'post' == $post_type ) {
			echo '<th class="category" scope="col" nowrap="nowrap">Category</th>';
		}
		echo '<th class="owner" scope="col">Author</th>';
		echo '<th class="published" scope="col">Published</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach ( $recents as $recent ) {
			echo '<tr>';
			echo '<td>';
			echo '<a href="/wp-admin/post.php?action=edit&post=' . $recent->ID . '">' . $recent->post_title . '</a>';
			echo '</td>';
			$status = ( 'publish' == $recent->post_status ) ? 'Published' : $recent->post_status;
			echo '<td>' . ucwords( $status ) . '</td>';
			if ( 'page' == $post_type ) {
				echo '<td>' . ucwords( syn_get_page_template( $recent->ID ) ) . '</td>';
			} elseif ( 'post' == $post_type ) {
				$categories = get_the_category( $recent->ID );
				$cats       = [];
				foreach ( $categories as $category ) {
					$cats[] = $category->name;
				}
				echo '<td>' . implode( ', ', $cats ) . '</td>';
			}
			echo '<td>' . get_the_author_meta( 'display_name', $recent->post_author ) . '</td>';
			echo '<td>' . syn_get_time_interval( $recent->post_date ) . ' ago</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}

	function syn_list_classes() {
		if ( ! is_admin() ) {
			return;
		}
		$user_id    = get_current_user_id();
		$is_teacher = get_field( 'syn_user_is_teacher', 'user_' . $user_id );
		if ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) ) {
			$teachers = syn_get_teachers();
		} elseif ( $is_teacher ) {
			$teachers   = [];
			$teachers[] = syn_get_teacher( $user_id );
		} else { // todo: fix when subscriber/contributor/non-teacher author are implemented, if ever
			$teachers = []; // nothing to show...
		}
		if ( $teachers ) {
			$terms          = syn_get_terms();
			$terms          = array_column( $terms, 'term', 'term_id' );
			$periods_active = get_field( 'syn_periods_active', 'option' );
			if ( $periods_active ) {
				$periods = get_field( 'syn_periods', 'option' );
				$periods = array_column( $periods, 'period', 'period_id' );
			}
			$rooms_active = get_field( 'syn_rooms_active', 'option' );
			if ( $rooms_active ) {
				$rooms = get_field( 'syn_rooms', 'option' );
				$rooms = array_column( $rooms, 'room', 'room_id' );
			}
			$courses = get_field( 'syn_courses', 'option' );
			$courses = array_column( $courses, 'course', 'course_id' );
			usort( $teachers, function( $a, $b ) {
				return strnatcmp( $a->user_lastname . ', ' . $a->user_firstname, $b->user_lastname . ', ' . $b->user_firstname );
			} );
			echo '<table class="admin-list">';
			echo '<thead>';
			echo '<tr>';
			echo '<th class="term" scope="col">Term</th>';
			echo '<th class="class" scope="col">Course</th>';
			if ( $periods_active ) {
				echo '<th class="period" scope="col">Period</th>';
			}
			if ( $rooms_active ) {
				echo '<th class="room" scope="col">Room</th>';
			}
			//echo '<th class="status" scope="col">Status</th>';
			echo '</tr>';
			echo '</thead>';
			$current_teacher = 0;
			$cols            = 2;
			$cols            = ( $periods_active ) ? $cols + 1 : $cols;
			$cols            = ( $rooms_active ) ? $cols + 1 : $cols;
			foreach ( $teachers as $teacher ) {
				$teacher_page = syn_get_teacher_page( $teacher->ID );
				if ( $teacher_page instanceof WP_Post || ( is_array( $teacher_page ) && count( $teacher_page ) ) ) {
					$teacher_page_status = $teacher_page->post_status;
					if ( ! $is_teacher && $teacher->ID != $current_teacher ) {
						echo '<thead>';
						echo '<tr class="list-group-header">';
						echo '<td colspan="' . $cols . '">';
						if ( $teacher_page ) :
							echo '<a href="/wp-admin/post.php?action=edit&post=' . $teacher_page->ID . '">' . $teacher->user_firstname . ' ' . $teacher->user_lastname . '</a>';
						else :
							echo $teacher->user_firstname . ' ' . $teacher->user_lastname;
						endif;
						echo '</td>';
						echo '</tr>';
						echo '</thead>';
						$current_teacher = $teacher->ID;
					}
					$classes = get_field( 'syn_classes', $teacher_page->ID );
					echo '<tbody>';
					if ( $classes ) {
						foreach ( $classes as $class ) {
							$class_page = syn_get_teacher_class_page( $teacher->ID, $class[ 'class_id' ] );
							//if ( $class_page instanceof WP_Post ) {
							$period = ( $periods_active && isset( $class[ 'period' ] ) ) ? $periods[ $class[ 'period' ] ] : '';
							$room   = ( $rooms_active && isset( $class[ 'room' ] ) ) ? $rooms[ $class[ 'room' ] ] : '';
							echo '<tr>';
							echo '<td>' . $terms[ $class[ 'term' ] ] . '</td>';
							echo '<td>';
							if ( $class_page instanceof WP_Post ) :
								$status = ( 'publish' == $class_page->post_status ) ? '' : '<strong> — ' . $class_page->post_status . '</strong>';
								echo '<a href="/wp-admin/post.php?action=edit&post=' . $class_page->ID . '">' . $class_page->post_title . '</a>' . ucwords( $status );
							else :
								//echo $class_page->post_title;
								echo $courses[ $class[ 'course' ] ];
							endif;
							echo '</td>';
							if ( $periods_active ) {
								//$period_label = ( $period ) ? 'Period ' . $period : '';
								echo '<td class="period">' . $period . '</td>';
							}
							if ( $rooms_active ) {
								//$room_label = ( $room ) ? 'Room ' . $room : '';
								echo '<td class="room">' . $room . '</td>';
							}
							/*if ( $class_page instanceof WP_Post ) {
								$status = ( 'publish' == $class_page->post_status ) ? 'Published' : $class_page->post_status;
								echo '<td class="status">' . $status . '</td>';
							} else {
								echo '<td></td>';
							}*/
							echo '</tr>';
							//}
						}
					} else {
						echo '<tr>';
						echo '<td colspan="' . $cols . '">';
						echo 'No classes';
						echo '</td>';
						echo '</tr>';
					};
					echo '</tbody>';
				}
			}
			echo '</table>';
		} else {
			echo '<table class="admin-list">';
			echo '<tbody>';
			echo '<tr>';
			echo '<td>';
			echo 'There are no teachers or you do not have permission to view them';
			echo '</td>';
			echo '</tr>';
			echo '</tbody>';
			echo '</table>';
		}
	}

	function syn_list_recently_modified() {

	}

	function syn_list_archived_classes() {
		echo 'archived classes table with Term, Course, Period, Room and Class Page';
	}

// quick nav
	function syn_qn_all_pages() {
		$qn_args = [
			'theme_location'  => 'primary',
			'container'       => '',
			'container_id'    => '',
			'container_class' => '',
			'menu_id'         => 'qn-all-pages',
			'menu_class'      => 'admin-nav-menu',
			//'depth'           => 0,
		];
		wp_nav_menu( (array) $qn_args );
	}

	function syn_qn_teachers_pages() {
		$teacher_pages = syn_get_teacher_pages();
		echo '<ul class="admin_pages_sidenav">';
		if ( $teacher_pages ) {
			$link_to_edit = get_admin_url() . '/post.php?action=edit&post=';
			foreach ( $teacher_pages as $teacher_page ) {
				$status = ( 'publish' != $teacher_page->post_status ) ? ' - ' . ucfirst( $teacher_page->post_status ) : '';
				echo '<li><a href="' . $link_to_edit . $teacher_page->ID . '">' . $teacher_page->post_title . '</a>' . $status . '</li>';
			}
		} else {
			echo '<li>No teacher pages</li>';
		}
		echo '</ul>';
	}

	function syn_qn_teachers_class_pages() {
		$posts = syn_get_teachers_class_pages();
		echo '<ul class="admin_pages_sidenav">';
		if ( $posts ) {
			$link_to_edit = get_admin_url() . '/post.php?action=edit&post=';
			$teacher_id   = 0;
			foreach ( $posts as $post ) {
				if ( $post instanceof WP_Post ) {
					$teacher = syn_get_teacher( get_field( 'syn_page_class_teacher', $post->ID ) );
					if ( $teacher_id != $teacher->ID ) {
						echo '<li><strong>' . $teacher->display_name . '</strong></li>';
						$teacher_id = $teacher->ID;
					}
					$status = ( 'publish' != $post->post_status ) ? ' - ' . ucfirst( $post->post_status ) : '';
					echo '<li><a href="' . $link_to_edit . $post->ID . '">' . $post->post_title . '</a>' . $status . '</li>';
				}
			}
		} else {
			echo '<li>No class pages</li>';
		}
		echo '</ul>';
	}

	function syn_get_time_interval( $date_time ) {
		$pub_interval = date_diff( date_create(), date_create( $date_time ) );
		$pub_days     = ( 0 < (int) $pub_interval->format( '%a' ) ) ? $pub_interval->format( '%a' ) : '';
		$pub_hours    = ( 0 < (int) $pub_interval->format( '%h' ) ) ? $pub_interval->format( '%h' ) : '';
		$pub_minutes  = ( 0 < (int) $pub_interval->format( '%i' ) ) ? $pub_interval->format( '%i' ) : '';
		$pub_since    = '';
		if ( 1 < $pub_days ) {
			$pub_since = $pub_days . ' days';
		} elseif ( 1 < $pub_hours ) {
			$pub_since = $pub_hours . ' hours';
		} elseif ( 1 < $pub_minutes ) {
			$pub_since = $pub_minutes . ' minutes';
		} else {
			$pub_since = 'Just now';
		}

		return $pub_since;
	}

	function syn_columns( $start = 2, $end = 6 ) {
		for ( $i = $start; $i <= $end; $i ++ ) {
			$width_pct = 100 / $i - 0.01;
			echo '<div class="d-flex flex-row" style="margin: 0 -5px;">';
			for ( $j = 1; $j <= $i; $j ++ ) {
				echo '<div style="width: ' . $width_pct . '%; text-align: left; margin: 5px; background-color: white; font-size: 0.75rem;">';
				//echo '<p>Fixed width:<br>';
				//echo 'Full width:</p>';
				echo '<img src="http://master.localhost/uploads/2018/01/images/bt_012-100x100.jpg" class="img-fluid img-thumbnail" style="width: 100%">';
				echo '</div>';
			}
			echo '</div>';
		}
	}

	// Add schwag to the list tables
	add_filter( 'views_edit-syn_calendar', 'syn_views_edit_syn_calendar', 10, 1 );
	function syn_views_edit_syn_calendar( $views ) {
		//slog( $views );
		$views[ 'google_calendar' ] = '<a href="http://calendar.google.com" target="_blank">Go to Google Calendar</a>';

		return $views;
	}