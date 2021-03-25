<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitffd0ec28c010aea5ce3251eb0877bdd4
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitffd0ec28c010aea5ce3251eb0877bdd4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitffd0ec28c010aea5ce3251eb0877bdd4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitffd0ec28c010aea5ce3251eb0877bdd4::$classMap;

        }, null, ClassLoader::class);
    }
}
