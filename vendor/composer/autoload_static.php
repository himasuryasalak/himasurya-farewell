<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite85b9efd181086a6cb7f18354a14afec
{
    public static $files = array (
        '3109cb1a231dcd04bee1f9f620d46975' => __DIR__ . '/..' . '/paragonie/sodium_compat/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite85b9efd181086a6cb7f18354a14afec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite85b9efd181086a6cb7f18354a14afec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite85b9efd181086a6cb7f18354a14afec::$classMap;

        }, null, ClassLoader::class);
    }
}
