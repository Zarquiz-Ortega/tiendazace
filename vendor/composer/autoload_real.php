<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf2bee5a3a57e5caa2b6aad0bbef92176
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitf2bee5a3a57e5caa2b6aad0bbef92176', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf2bee5a3a57e5caa2b6aad0bbef92176', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf2bee5a3a57e5caa2b6aad0bbef92176::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
