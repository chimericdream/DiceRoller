<?php
namespace WorldOfPannotia;

/**
 * @codeCoverageIgnore
 */
class Autoload
{
    public static function autoloadHelper($c)
    {
        $paths = array(
            __DIR__ . '/../', // does this work?
            __DIR__ . '/../', // does this work?
        );

        $class = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $c);
        for ($i = 0; $i < count($paths); $i++) {
            if (is_readable("{$paths[$i]}{$class}.php")) {
                require_once "{$paths[$i]}{$class}.php";
                return;
            }
        }
    }

    public static function register()
    {
        \spl_autoload_register('\WorldOfPannotia\Autoload::autoloadHelper');
    }
}
