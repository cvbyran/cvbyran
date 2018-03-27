<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c41a74c80d8037a74c1f48d52906f2f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c41a74c80d8037a74c1f48d52906f2f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c41a74c80d8037a74c1f48d52906f2f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
