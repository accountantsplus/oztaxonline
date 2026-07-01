<?php
/**
 * Shared DB + session helpers (Oz Tax Online).
 * Include this file first on every PHP page: require_once 'db_connect.php';
 * Connects to the same shared scheduler DB used by PoliceTax.
 */

function ptx_db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=accoun40_accounta_scheduler_tax;charset=utf8mb4',
            'accoun40_root',
            'Dusty@0007',
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
    return $pdo;
}

function ptx_session_start(): void {
    if (session_status() === PHP_SESSION_NONE) {
        $lifetime = 7 * 24 * 60 * 60; // 604800 seconds

        ini_set('session.gc_maxlifetime', (string)$lifetime);

        // Share the session across www and non-www on oztaxonline.com.au.
        $domain = (!empty($_SERVER['HTTP_HOST'])
            && strpos($_SERVER['HTTP_HOST'], 'oztaxonline.com.au') !== false)
            ? '.oztaxonline.com.au' : '';
        session_set_cookie_params([
            'lifetime' => $lifetime,
            'path'     => '/',
            'domain'   => $domain,
            'secure'   => true,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}
