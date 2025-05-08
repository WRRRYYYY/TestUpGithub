<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Recaptcha_cfg extends BaseConfig
{
    /*
    * Recaptha Google
    *
    * See link below for setup and get key
    * http://www.google.com/recaptcha/admin
    */
    // public $recaptcha_site_key = '6Lc2zY8qAAAAABtRlFCNv9jEsCor8mXqGW26lf1C';
    // public $recaptcha_secret_key = '6Lc2zY8qAAAAAJCThzndAKJ3V1NzYlU5ZluxJmqP';
    public $recaptcha_site_key = '6Ld58-gqAAAAAE-XnIt8KlvSeZcCmVeQhkuwW8GH';
    public $recaptcha_secret_key = '6Ld58-gqAAAAADLrW7LoK4XUAFXXAT75wnnrRrUC';

    public $recaptcha_lang = 'en';
}
