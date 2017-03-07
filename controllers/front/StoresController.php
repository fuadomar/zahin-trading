<?php
class StoresController extends StoresControllerCore {
    public $google_map_api_key = 'AIzaSyBAfftN2BAoNFqwWrmBmh6OzsHSm8xwuVI';

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_.'stores.css');

        if (!Configuration::get('PS_STORES_SIMPLIFIED')) {
            $default_country = new Country((int)Tools::getCountry());
            $this->addJS('http'.((Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE')) ? 's' : '').'://maps.google.com/maps/api/js?key='.$this->google_map_api_key.'&sensor=true&region='.substr($default_country->iso_code, 0, 2));
            $this->addJS(_THEME_JS_DIR_.'stores.js');
        }
    }
}
