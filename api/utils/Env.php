<?php

class Env
{
      private static function getEnvKeys() {
            $path = DIR.".env";
            $finalAssociativeArray = array();

            if (!file_exists($path)) return [];

            $environ = file_get_contents($path);

            foreach (explode("\n", $environ) as $var) {
                  $exploded = explode("=", $var);
                  $finalAssociativeArray[trim($exploded[0])] = trim($exploded[1]);
            }

            return $finalAssociativeArray;
      }
      

      public static function getEnvVars()
      {
            if (DEV) {
                  return self::getEnvKeys();
            }

            return array(
                  'DB_HOST' => getenv('DB_HOST'),
                  'DB_USER' => getenv('DB_USER'),
                  'DB_PWD' => getenv('DB_PWD'),
                  'FTP_USER' => getenv('FTP_USER'),
                  'FTP_PWD' => getenv('FTP_PWD'),
                  'FTP_HOST' => getenv('FTP_HOST'),
            );
      }
}
