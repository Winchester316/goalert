<?php

declare(strict_types=1);

// DATABASE: LOCAL
$host = define("HOST", "localhost");
$db = define("DB_NAME", "goalert");
$tables = define("DB_TABLES", ["coordinates", "notifications", "survey", "users"]);
$user = define("DB_USER", "root");
$password = define("DB_PASSWORD", "");

// Character Set
$charset = define("CHARSET", "utf8mb4");

// Check if already defined
if (!defined("CHARSET")) $charset;

// Check if already defined
if (!defined("HOST")) $host;
if (!defined("DB_NAME")) $db;
if (!defined("DB_TABLES")) $tables;
if (!defined("DB_USER")) $user;
if (!defined("DB_PASSWORD")) $password;

/**
 * Class Database
 */
class Database extends PDO
{
    /**
     * Database constructor.
     * @param $dsn
     * @param null $username
     * @param null $password
     * @param array $options
     */
    public function __construct($dsn, $username = NULL, $password = NULL, $options = [])
    {
        parent::__construct($dsn, $username, $password, $options);
    }
}


$dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET;
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];

$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

