<?php
/** @var string $logoUrl */
?>
<div id="convkit-plugin-settings-page-wrapper">

    <h1>
        <a href="https://convkit.com" title="ConvKit" target="_blank"><img src="<?php echo esc_url($logoUrl); ?>" alt="ConvKit logo"></a>
    </h1>

    <h2>Thank you for choosing ConvKit!</h2>
    <p>
        To install ConvKit plugin first you need to register to ConvKit and fetch your API key.
        You can register to ConvKit here: <a href="https://convkit.com/en/registration" target="_blank">ConvKit registration</a>
    </p>

    <p>
    After you have registered and logged in to ConvKit visit the <a href="https://convkit.com/en/dashboard/getting-started" target="_blank">How do I get started</a> page.
    On this page, you can find your web API key. <br />
    Copy the <strong>web API key</strong> and paste it to the API key field on the left side of this page.<br />
    Click on the <strong>Save settings</strong> button to finish the configuration.
    </p>

    <p>
    That’s it.<br />
    ConvKit is ready to use on your Wordpress site.<br />
    Why don’t you create your first campaign? Please visit the <a href="https://convkit.com/en/dashboard/faq" target="_blank"> FAQ page</a>.
    </p>
    <hr />

    <div class="wrap">
        <h2 class="wp-heading-inline"><?php echo esc_html( __('ConvKit settings', 'convkit') ); ?></h2>

    <div id="convkit-plugin-settings-success" class="updated notice" style="display: none">
        <p><strong><?php echo esc_html( __('Settings saved.', 'convkit') ); ?></strong></p>
    </div>
    <div id="convkit-plugin-settings-error" class="updated error" style="display: none">
        <p><strong><?php echo esc_html( __('Save error! Please reload this page and tray again.', 'convkit') ); ?></strong></p>
    </div>
    <div id="convkit-plugin-settings-invalid-key" class="updated error" style="display: none">
        <p><strong><?php echo esc_html( __('Invalid API key.', 'convkit') ); ?></strong></p>
    </div>


    <form id="convkit-plugin-settings" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" data-check-url-tpl="<?php echo esc_attr(ConvKitPlugin::API_KEY_CHECK_URL_TPL)?>" >
        <input type="hidden"
            name="action"
            value="setting_form"
        />

        <label for="<?php echo esc_attr(ConvKitPlugin::OPT_NAME_API_KEY) ?>"><?php echo esc_html( __('API key', 'convkit') ); ?>:</label>
        <input type="text"
               data-convkit-type="api-key"
               name="<?php echo esc_attr(ConvKitPlugin::OPT_NAME_API_KEY) ?>"
               id="<?php echo esc_attr(ConvKitPlugin::OPT_NAME_API_KEY) ?>"
               value="<?php echo esc_attr(get_option(ConvKitPlugin::OPT_NAME_API_KEY)); ?>"
               pattern="<?php echo esc_attr(ConvKitPlugin::API_KEY_HTML_PATTERN) ?>"
               required="required"
               oninvalid="this.setCustomValidity('<?php echo esc_attr( __('The api key contains only letters and numbers and is 8 characters long!', 'convkit') ); ?>')"
               oninput="this.setCustomValidity('')"
        />

        <?php @submit_button(); ?>
    </form>
    </div>
</div>
