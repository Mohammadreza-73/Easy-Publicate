<?php

namespace App\Helpers;

use App\Exceptions\ConfigFileNotExistsException;

class Config
{
    /**
     * Get Array of Config file
     *
     * @param string $fileName
     * @throws ConfigFileNotExistsException
     * @return array Config
     */
    public static function getFileContents(string $fileName): array
    {
        $filePath = realpath(__DIR__ . '/../Configs/' . $fileName . '.php');
        if (! $filePath )
            throw new ConfigFileNotExistsException("Config file $fileName not exists");

        $fileContent = require $filePath;
        
        return $fileContent;
    }

    /**
     * Get Specific part of config file or get all of them from
     *
     * @param string $fileName
     * @param string $key
     * @throws ConfigFileNotExistsException
     * @return mixed
     */
    public static function get(string $fileName, string $key = null)
    {
        $fileContents = self::getFileContents($fileName);

        if ( is_null($key) ) return $fileContents;
        return $fileContents[$key] ?? null;
    }
}