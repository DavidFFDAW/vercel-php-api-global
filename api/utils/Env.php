<?php

class Env
{
      public static function getEnvVars()
      {
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
