<?php

namespace Lib;

class GeneratorUtils {

    public static function createDirectory($path, $permissions = 0777, $recursive = true): bool
    {
        # create directory if not exists
        if(!is_dir($path)) {
            mkdir($path, $permissions, $recursive);
            return true;
        }
        return false;
    }

    public static function copyTemplate($src, $dest, $placeholders): string
    {
        $content = file_get_contents($src);
        $content = str_replace(array_keys($placeholders),array_values($placeholders), $content);

        file_put_contents($dest, $content);

        return $content;
    }
}



