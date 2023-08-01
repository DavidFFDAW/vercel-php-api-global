<?php

class Env
{
      private static function getEnvFileVars()
      {
            $envFile = DIR . ".env";
            $vars = array();

            if (!file_exists($envFile)) return [];

            $contents = file_get_contents($envFile);

            foreach (explode("\n", $contents) as $var) {
                  $exp = explode("=", $var);
                  $vars[trim($exp[0])] = trim($exp[1]);
            }

            return $vars;
      }

      private static function getVars($isDev)
      {
            if ($isDev) return self::getEnvFileVars();

            return array(
                  'DB_USER' => getenv('DB_USER'),
                  'DB_PWD' => getenv('DB_PWD'),
                  'FTP_USER' => getenv('FTP_USER'),
                  'FTP_PWD' => getenv('FTP_PWD'),
                  'FTP_HOST' => getenv('FTP_HOST'),
            );
      }

      public static function getEnvVars()
      {
            $env = self::getVars(DEV);

            return array(
                  'DB_HOST' => isset($env['DB_HOST']) ? $env['DB_HOST'] : '',
                  'DB_USER' => isset($env['DB_USER']) ? $env['DB_USER'] : '',
                  'DB_PWD' => isset($env['DB_PWD']) ? $env['DB_PWD'] : '',
                  'FTP_USER' => isset($env['FTP_USER']) ? $env['FTP_USER'] : '',
                  'FTP_PWD' => isset($env['FTP_PWD']) ? $env['FTP_PWD'] : '',
                  'FTP_HOST' => isset($env['FTP_HOST']) ? $env['FTP_HOST'] : '',
            );
      }
}
