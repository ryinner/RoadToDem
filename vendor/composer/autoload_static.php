<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb5df3e8f3d8f078071c1e1b548ceeab7
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MasterOk\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MasterOk\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb5df3e8f3d8f078071c1e1b548ceeab7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb5df3e8f3d8f078071c1e1b548ceeab7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
