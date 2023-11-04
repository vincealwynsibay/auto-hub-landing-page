<?php

declare(strict_types=1);

$server     = "localhost";
$username   = "root";
$password   = "vince";
$database   = "car dealer";
$port       = 3306;

$conCD = mysqli_connect($server, $username, $password, $database, $port);

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Cloudinary\Configuration\Configuration;

Configuration::instance([
    'cloud' => [
        'cloud_name' => $_ENV["CLOUDINARY_CLOUD_NAME"],
        'api_key' => $_ENV["CLOUDINARY_API_KEY"],
        'api_secret' => $_ENV["CLOUDINARY_API_SECRET"],
    ],
    'url' => [
        'secure' => true
    ]
]);

if ($conCD->connect_error) {
    die("Connection Error, Check Database Credentials." . $conCD->connect_error);
} else {
    // echo "Connection success!";
}
