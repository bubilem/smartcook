<?php

/**
 * Application class loader
 */
class Loader
{

    /**
     * Associative array of class types and theirs directories
     *
     * @var array
     */
    public static $classTypes = [
        'Controller' => DIR_APP . 'controllers',
        'Model' => DIR_APP . 'models',
        'View' => DIR_APP . 'views'
    ];

    /**
     * Default class directory
     */
    const DEFAULT_CLASS_DIR = DIR_APP . 'utils';

    /**
     * Main load method - makes require class file
     *
     * @param string $className
     * @return void
     */
    public static function loadClass(string $className)
    {
        $path = self::detectClassTypeDir($className) . '/' . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
        } else {
            exit("Class $className not found!");
        }
    }

    /**
     * Specifies by class name its directory
     *
     * @param string $className
     * @return string
     */
    private static function detectClassTypeDir(string $className): string
    {
        foreach (self::$classTypes as $classTypeName => $classTypeDirectory) {
            if (preg_match('~.*' . $classTypeName . '$~', $className)) {
                return $classTypeDirectory;
            }
        }
        return self::DEFAULT_CLASS_DIR;
    }
}
