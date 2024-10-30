<?php

class ConvKitAdminApp {

    const NAME = 'convkit_admin_app';
    const FORCE_SETTINGS_OPT_NAME = 'convkitNeedPluginSettings';

    /**
     * @var ConvKitAdminSettingsPage
     */
    private $settingsPage;

    /**
     * @param ConvKitAdminSettingsPage $settingsPage
     */
    public function __construct(ConvKitAdminSettingsPage $settingsPage)
    {
        $this->settingsPage = $settingsPage;
    }

    public function run(){

        register_activation_hook(CONVKIT_PLUGIN_ROOT_FILE, array($this, 'onActivate'));

        add_action('admin_init', array($this, 'handleForceSettings'));
        add_action('admin_init', array($this, 'initSettings'));
        add_action('admin_menu', array($this, 'initMenu'));
        add_action('admin_enqueue_scripts', array($this, 'initAssetic'));
        add_action('plugins_loaded', array($this, 'initTranslation'));

        add_filter('plugin_action_links_' . plugin_basename(CONVKIT_PLUGIN_ROOT_FILE), array($this->settingsPage, 'addSettingsPageLink'));
        add_action('wp_ajax_setting_form', array($this->settingsPage, 'handleSettingsRequest'));
        add_action('admin_post_convkit_settings', array($this->settingsPage, 'handleSettingsRequest'));
    }

    public function initSettings()
    {
        register_setting(ConvKitPlugin::OPT_GROUP, ConvKitPlugin::OPT_SHORT_NAME_API_KEY, array(
            'show_in_rest' => false,
            'type'         => 'string',
            'description'  => __( 'API key for ConvKit service.', 'convkit' ),
        ));
    }

    public function initMenu()
    {
        add_submenu_page(
            'themes.php',
            __('ConvKit', 'convkit'),
            __('ConvKit', 'convkit'),
            'edit_theme_options',
            'convkit',
            array($this->settingsPage, 'render')
        );
    }

    public function initAssetic()
    {
        wp_enqueue_style('convkit-admin-css', plugin_dir_url(CONVKIT_PLUGIN_ROOT_FILE) . 'assets/css/convkit-admin.css');
        wp_enqueue_script('convkit-admin-js', plugin_dir_url(CONVKIT_PLUGIN_ROOT_FILE) . 'assets/js/convkit-admin.js');
    }

    public function initTranslation()
    {
        load_plugin_textdomain('convkit', FALSE, CONVKIT_PLUGIN_ROOT_PATH . '/languages/');
    }

    public function onActivate()
    {
        add_option(self::FORCE_SETTINGS_OPT_NAME, true);
    }

    public function handleForceSettings()
    {
        if (get_option(self::FORCE_SETTINGS_OPT_NAME, false)) {
            delete_option(self::FORCE_SETTINGS_OPT_NAME);
            wp_redirect(ConvKitAdminSettingsPage::PAGE_URL);
        }
    }
}
