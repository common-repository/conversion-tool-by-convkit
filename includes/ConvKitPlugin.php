<?php

class ConvKitPlugin {
    const NAME = 'convkit_plugin';

    const API_KEY_PATTERN = '/^[a-zA-Z0-9]{8}$/';
    const API_KEY_HTML_PATTERN = '[a-zA-Z0-9]{8}';
    const API_KEY_CHECK_URL_TPL = 'https://{{apiKey}}-api.convkit.com/v1/webshop/{{apiKey}}/check';

    const INIT_SCRIPT_CDN_URL_TPL = 'https://{{apiKey}}-cdn.convkit.com/convkit-init.js';

    const OPT_GROUP = 'convkit';
    const OPT_SHORT_NAME_API_KEY = 'api_key';
    const OPT_NAME_API_KEY = 'convkit_api_key';


    public static function isValidApiKey($dirtyApiKey){
        return false !== preg_match(self::API_KEY_PATTERN, $dirtyApiKey);
    }


}
