<?php

class ConvKitAdminSettingsPage
{
    const PAGE_URL = 'themes.php?page=convkit';

    public function render()
    {
        $logoUrl = plugin_dir_url(CONVKIT_PLUGIN_ROOT_FILE) . 'assets/img/convkit-logo-web.png';

        require CONVKIT_PLUGIN_ROOT_PATH . '/templates/ConvKitAdminSettingsPage.tpl.php';
    }

    public function addSettingsPageLink($links)
    {
        array_unshift($links, sprintf(
            '<a href="%s">%s</a>',
            self::PAGE_URL,
            __('ConvKit settings', 'convkit')
        ));

        return $links;
    }

    public function handleSettingsRequest()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permissions to manage plugin settings', 'convkit'));
        }

        $result = array(
            'success' => 0
        );

        $key = sanitize_text_field($_POST[ConvKitPlugin::OPT_NAME_API_KEY]);

        if (ConvKitPlugin::isValidApiKey($key)) {
            $result['success'] = 1;
            update_option(ConvKitPlugin::OPT_NAME_API_KEY, $key, true);
        }

        wp_send_json($result);
    }
}
