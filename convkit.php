<?php

/**
 * Plugin Name:       Conversion tool by ConvKit
 * Description:       Happy new leads converted to customers, and profit increase!
 * Version:           1.0.0
 * Requires at least: 4.9
 * Requires PHP:      5.6
 * Author:            ConvKit Developer Team
 * Author URI:        https://convkit.com
 * License:           GPL v2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       convkit
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('CONVKIT_PLUGIN_ROOT_FILE', __FILE__);
define('CONVKIT_PLUGIN_ROOT_PATH', dirname(CONVKIT_PLUGIN_ROOT_FILE));

require_once  CONVKIT_PLUGIN_ROOT_PATH . '/includes/ConvKitContainer.php';
require_once  CONVKIT_PLUGIN_ROOT_PATH . '/includes/ConvKitPlugin.php';
require_once  CONVKIT_PLUGIN_ROOT_PATH . '/includes/ConvKitAdminApp.php';
require_once  CONVKIT_PLUGIN_ROOT_PATH . '/includes/ConvKitFrontApp.php';



$container = ConvKitContainer::getInstance();
$container->set(ConvKitPlugin::NAME, new ConvKitPlugin());

if( is_admin() ){
    require_once CONVKIT_PLUGIN_ROOT_PATH . '/includes/ConvKitAdminSettingsPage.php';
    $app = new ConvKitAdminApp( new ConvKitAdminSettingsPage() );
    $container->set(ConvKitAdminApp::NAME, $app);
    $app->run();
}
else{
    $container->set(ConvKitFrontApp::NAME, $app = new ConvKitFrontApp());
    $app->run();
}



