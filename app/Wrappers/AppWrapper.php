<?php

namespace App\Wrappers;

class AppWrapper {
    private static $app;

    private function __construct() {

    }

    public static function getInstance($app = null) {
        if (!self::$app) {
            if (!$app) {
                throw new \Exception('App instance is required!');
            }
            self::$app = $app;
        }
        return self::$app;
    }
}
