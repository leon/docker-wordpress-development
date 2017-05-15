<?php

// Database
define('DB_HOST', 'mysql');
define('DB_NAME', 'wordpress');
define('DB_USER', 'root');
define('DB_PASSWORD', '42');
define('DB_CHARSET', $_SERVER['MYSQL_CHARSET'] ?? 'utf8');
define('DB_COLLATE', $_SERVER['MYSQL_COLLATE'] ?? '');

// Table prefix
$table_prefix  = 'wp_';

// Change Content Directory
$host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', $host . '/wp-content');

define('WP_SITEURL', $host . '/wp');

// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
define('AUTH_KEY',         'worpress-docker-dev');
define('SECURE_AUTH_KEY',  'worpress-docker-dev');
define('LOGGED_IN_KEY',    'worpress-docker-dev');
define('NONCE_KEY',        'worpress-docker-dev');
define('AUTH_SALT',        'worpress-docker-dev');
define('SECURE_AUTH_SALT', 'worpress-docker-dev');
define('LOGGED_IN_SALT',   'worpress-docker-dev');
define('NONCE_SALT',       'worpress-docker-dev');

// Disable all updates, since we handle this with composer
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

// Direct upgrade
//define('FS_METHOD', 'direct');

// Bootstrap WordPress
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/wp/');
}
require_once(ABSPATH . 'wp-settings.php');
