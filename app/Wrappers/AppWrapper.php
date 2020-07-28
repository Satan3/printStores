<?php

namespace App\Wrappers;

use Slim\App;

class AppWrapper {
    private static $app;

    private function __construct() {

    }

    public static function getInstance($app = null): App {
        if (!self::$app) {
            if (!$app) {
                die('App instance is required!');
            }
            self::$app = $app;
        }
        return self::$app;
    }
}
