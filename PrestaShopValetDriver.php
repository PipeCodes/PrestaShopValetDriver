<?php

namespace Valet\Drivers\Custom;

use Valet\Drivers\ValetDriver;

class PrestaShopValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        return file_exists($sitePath . '/classes/PrestaShopAutoload.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)
    {
        // Basic static file
        if (is_file($staticFilePath = "{$sitePath}/{$uri}")) {
            return $staticFilePath;
        }

        // rewrite categories images
        if (preg_match('/c\/([0-9]*)-category_default\/.*\.jpg/', $uri, $matches)) {
            $staticFilePath = "{$sitePath}/img/c/{$matches[1]}.jpg";
            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$4/$5/$6/$7/$8/$1$2$3$4$5$6$7$8$9$10.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[4]}/{$matches[5]}/{$matches[6]}/{$matches[7]}/{$matches[8]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}{$matches[6]}{$matches[7]}{$matches[8]}{$matches[9]}{$matches[10]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$4/$5/$6/$7/$1$2$3$4$5$6$7$8$9.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[4]}/{$matches[5]}/{$matches[6]}/{$matches[7]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}{$matches[6]}{$matches[7]}{$matches[8]}{$matches[9]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$4/$5/$6/$1$2$3$4$5$6$7$8.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[4]}/{$matches[5]}/{$matches[6]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}{$matches[6]}{$matches[7]}{$matches[8]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$4/$5/$1$2$3$4$5$6$7.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[4]}/{$matches[5]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}{$matches[6]}{$matches[7]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$4/$1$2$3$4$5$6.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[4]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}{$matches[6]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$3/$1$2$3$4$5.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}.jpg")) {
                return $staticFilePath;
            }
        }


        // rewrite ^/([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$2/$1$2$3$4.jpg last;
        if (preg_match('/([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[1]}{$matches[2]}{$matches[3]}.jpg")) {
                return $staticFilePath;
            }
        }

        // rewrite ^/([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+.jpg$ /img/p/$1/$1$2$3.jpg last;
        if (preg_match('/([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?\/.+\.jpg/i', $uri, $matches)) {
            if (is_file($staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[1]}{$matches[2]}{$matches[3]}.jpg")) {
                return $staticFilePath;
            }
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): string
    {
        //Legacy URls
        $parts = explode('/', $uri);
        if (isset($parts[1]) && $parts[1] != '' && file_exists($adminIdex = $sitePath . '/' . $parts[1] . '/index.php')) {
            $_SERVER['SCRIPT_FILENAME'] = $adminIdex;
            $_SERVER['SCRIPT_NAME'] = '/' . $parts[1] . '/index.php';
            if (isset($_GET['controller']) || isset($_GET['tab'])) {
                return $adminIdex;
            }
            return $adminIdex;
        }
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $_SERVER['SCRIPT_FILENAME'] = $sitePath . '/index.php';
        return $sitePath . '/index.php';
    }
}
