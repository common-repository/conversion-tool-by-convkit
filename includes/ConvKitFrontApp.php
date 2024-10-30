<?php

class ConvKitFrontApp{

    const NAME = 'convkit_front_app';

    public function run(){
        add_action('wp_enqueue_scripts', array($this, 'initAssetic'));
    }

    public function initAssetic()
    {
        $apiKey = get_option(ConvKitPlugin::OPT_NAME_API_KEY);
        if( !empty($apiKey) ){
            wp_enqueue_script(
                'convkit-init-js',
                strtr(ConvKitPlugin::INIT_SCRIPT_CDN_URL_TPL, array('{{apiKey}}' => $apiKey))
            );

        }
    }

}
