<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInitb161589473726196eb81b56412e8e85f', false)) {
    class_exists('WPSentry\ScopedVendor\ComposerAutoloaderInitb161589473726196eb81b56412e8e85f');
}
if (!class_exists('ValueError', false)) {
    class_exists('WPSentry\ScopedVendor\ValueError');
}
if (!class_exists('Stringable', false)) {
    class_exists('WPSentry\ScopedVendor\Stringable');
}
if (!class_exists('UnhandledMatchError', false)) {
    class_exists('WPSentry\ScopedVendor\UnhandledMatchError');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('composerRequireb161589473726196eb81b56412e8e85f')) {
    function composerRequireb161589473726196eb81b56412e8e85f() {
        return \WPSentry\ScopedVendor\composerRequireb161589473726196eb81b56412e8e85f(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \WPSentry\ScopedVendor\includeIfExists(...func_get_args());
    }
}
if (!function_exists('uuid_create')) {
    function uuid_create() {
        return \WPSentry\ScopedVendor\uuid_create(...func_get_args());
    }
}
if (!function_exists('uuid_generate_md5')) {
    function uuid_generate_md5() {
        return \WPSentry\ScopedVendor\uuid_generate_md5(...func_get_args());
    }
}
if (!function_exists('uuid_generate_sha1')) {
    function uuid_generate_sha1() {
        return \WPSentry\ScopedVendor\uuid_generate_sha1(...func_get_args());
    }
}
if (!function_exists('uuid_is_valid')) {
    function uuid_is_valid() {
        return \WPSentry\ScopedVendor\uuid_is_valid(...func_get_args());
    }
}
if (!function_exists('uuid_compare')) {
    function uuid_compare() {
        return \WPSentry\ScopedVendor\uuid_compare(...func_get_args());
    }
}
if (!function_exists('uuid_is_null')) {
    function uuid_is_null() {
        return \WPSentry\ScopedVendor\uuid_is_null(...func_get_args());
    }
}
if (!function_exists('uuid_type')) {
    function uuid_type() {
        return \WPSentry\ScopedVendor\uuid_type(...func_get_args());
    }
}
if (!function_exists('uuid_variant')) {
    function uuid_variant() {
        return \WPSentry\ScopedVendor\uuid_variant(...func_get_args());
    }
}
if (!function_exists('uuid_time')) {
    function uuid_time() {
        return \WPSentry\ScopedVendor\uuid_time(...func_get_args());
    }
}
if (!function_exists('uuid_mac')) {
    function uuid_mac() {
        return \WPSentry\ScopedVendor\uuid_mac(...func_get_args());
    }
}
if (!function_exists('uuid_parse')) {
    function uuid_parse() {
        return \WPSentry\ScopedVendor\uuid_parse(...func_get_args());
    }
}
if (!function_exists('uuid_unparse')) {
    function uuid_unparse() {
        return \WPSentry\ScopedVendor\uuid_unparse(...func_get_args());
    }
}
if (!function_exists('fdiv')) {
    function fdiv() {
        return \WPSentry\ScopedVendor\fdiv(...func_get_args());
    }
}
if (!function_exists('preg_last_error_msg')) {
    function preg_last_error_msg() {
        return \WPSentry\ScopedVendor\preg_last_error_msg(...func_get_args());
    }
}
if (!function_exists('str_contains')) {
    function str_contains() {
        return \WPSentry\ScopedVendor\str_contains(...func_get_args());
    }
}
if (!function_exists('str_starts_with')) {
    function str_starts_with() {
        return \WPSentry\ScopedVendor\str_starts_with(...func_get_args());
    }
}
if (!function_exists('str_ends_with')) {
    function str_ends_with() {
        return \WPSentry\ScopedVendor\str_ends_with(...func_get_args());
    }
}
if (!function_exists('get_debug_type')) {
    function get_debug_type() {
        return \WPSentry\ScopedVendor\get_debug_type(...func_get_args());
    }
}
if (!function_exists('get_resource_id')) {
    function get_resource_id() {
        return \WPSentry\ScopedVendor\get_resource_id(...func_get_args());
    }
}

return $loader;
