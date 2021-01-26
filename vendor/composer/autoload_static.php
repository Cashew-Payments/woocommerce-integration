<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitedced5e8c6bf1ee11d0a96e5d8ae1f96
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Cashewpayments\\' => 8,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cashewpayments\\' => 
        array (
            0 => __DIR__ . '/..' . '/cashewpayments/cashewpayments-php/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitedced5e8c6bf1ee11d0a96e5d8ae1f96::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitedced5e8c6bf1ee11d0a96e5d8ae1f96::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
