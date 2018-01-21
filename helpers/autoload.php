<?php

use Phalcon\DiInterface;

if (!function_exists('autoload')) {
    /**
     * Autoload files in specified directories.
     *
     * @param DiInterface $di
     * @param array $dirs
     */
    function autoload(DiInterface $di, array $dirs)
    {
        foreach ($dirs as $dir) {
            $files = scandir(ROOT_DIR . '/' . $dir);
            $files = array_diff($files, ['..', '.']);
            foreach ($files as $file) {
                require ROOT_DIR . '/' . $dir . '/' . $file;
            }
        }
    }
}
