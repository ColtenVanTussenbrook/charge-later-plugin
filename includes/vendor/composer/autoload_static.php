<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf222ece3279682b46febaee76ba96a65
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf222ece3279682b46febaee76ba96a65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf222ece3279682b46febaee76ba96a65::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
