<?php
/**
 * Disable all automatic updates.
 *
 * Core, plugin, and theme versions are controlled through code/deploys,
 * so WordPress must never self-update in any environment.
 *
 * @package TheEquityFund
 */

// Master switch — covers core, plugins, themes, and translations.
add_filter( 'automatic_updater_disabled', '__return_true' );

// Hide the "Enable auto-updates" toggles in the plugins/themes admin screens
// so auto-updates can't be re-enabled per item from the UI.
add_filter( 'plugins_auto_update_enabled', '__return_false' );
add_filter( 'themes_auto_update_enabled', '__return_false' );
