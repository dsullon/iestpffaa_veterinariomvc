<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b9fc04dc594a12200478d5b117f5b30
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
        'A' => 
        array (
            'APP\\' => 4,
            'API\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'APP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'API\\' => 
        array (
            0 => __DIR__ . '/../..' . '/api',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b9fc04dc594a12200478d5b117f5b30::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b9fc04dc594a12200478d5b117f5b30::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7b9fc04dc594a12200478d5b117f5b30::$classMap;

        }, null, ClassLoader::class);
    }
}
