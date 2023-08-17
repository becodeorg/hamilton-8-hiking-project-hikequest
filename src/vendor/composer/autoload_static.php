<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd3ce80ee997baf94319163c9772d9810
{
    public static $classMap = array (
        'ComposerAutoloaderInitd3ce80ee997baf94319163c9772d9810' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInitd3ce80ee997baf94319163c9772d9810' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Controllers\\AuthController' => __DIR__ . '/../..' . '/controllers/Authcontroller.php',
        'Controllers\\HikeController' => __DIR__ . '/../..' . '/controllers/HikesController.php',
        'Models\\Database' => __DIR__ . '/../..' . '/models/Database.php',
        'Models\\Hike' => __DIR__ . '/../..' . '/models/Hike.php',
        'Models\\Tags' => __DIR__ . '/../..' . '/models/Tags.php',
        'Models\\User' => __DIR__ . '/../..' . '/models/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitd3ce80ee997baf94319163c9772d9810::$classMap;

        }, null, ClassLoader::class);
    }
}
