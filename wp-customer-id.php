<?php
/*
Plugin Name: WP Customer ID
Plugin URI: https://github.com/jovtrc/wp-customer-id
Description: A simple WordPress plugin that generates an unique customer ID to the users registered in the site.
Author: João Carvalho
Version: 0.1
Author URI: https://joaocarvalho.cc
*/

// The plugin actions goes here
register_activation_hook(__FILE__, 'WPCID_PluginActivate'); // Create the IDs when plugin activated
add_action('user_register', 'WPCID_NewUserCustomerId'); // Create the ID whe user is created
add_shortcode('show_customer_id', 'WPCID_RenderShortcode'); // Shortcode to render the Customer ID

function WPCID_PluginActivate()
{
    $allUsersIds = get_users(['fields' => 'ID']);

    foreach ($allUsersIds as $userId) {
        $customerId = ($userId + 2) * 3;

        update_user_meta($userId, 'wpcid_customer_id', $customerId);
    }
}

function WPCID_NewUserCustomerId($userId)
{
    $customerId = ($userId + 2) * 3;

    update_user_meta($userId, 'wpcid_customer_id', $customerId);
}

function WPCID_RenderShortcode($atts)
{
    $userCustomerId = get_the_customer_id();

    if (!$userCustomerId) {
        return false;
    }

    $atts = shortcode_atts([
        'only_id' => 'no'
    ], $atts, 'show_customer_id');

    $content = $atts['only_id'] = 'no'
        ? '<div class="wpcid-customer-id">' . $userCustomerId . '</div>'
        : '<div class="wpcid-customer-id">Customer ID: <span>' . $userCustomerId . '</span></div>';

    return wp_kses_post($content);
}

// Functions to use on the theme
function get_the_customer_id()
{
    $userId = get_current_user_id();

    if ($userId === 0) {
        return false;
    }

    $userCustomerId = get_user_meta($userId, 'wpcid_customer_id', true);

    if (empty($userCustomerId)) {
        return false;
    }

    return $userCustomerId;
}

function the_customer_id($before = '', $after = '', $echo = true)
{
    $userCustomerId = get_the_customer_id();

    if (!$userCustomerId) {
        return false;
    }

    $userCustomerId = $before . $userCustomerId . $after;

    if ($echo) {
        echo wp_kses_post($userCustomerId);
    } else {
        return wp_kses_post($userCustomerId);
    }
}
