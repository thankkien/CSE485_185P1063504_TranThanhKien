<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb4413b67385dfba90e494e541a94e05d
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb4413b67385dfba90e494e541a94e05d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb4413b67385dfba90e494e541a94e05d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb4413b67385dfba90e494e541a94e05d::$classMap;

        }, null, ClassLoader::class);
    }
}