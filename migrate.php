<?php

require_once __DIR__ . '/helpers.php';

$conn = open_connection();
mysqli_query($conn, <<<SQL
CREATE TABLE IF NOT EXISTS `categories` (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;
SQL
);

mysqli_query($conn, <<<SQL
CREATE TABLE IF NOT EXISTS `transactions` (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_id INT(11) UNSIGNED NULL DEFAULT NULL,
    amount DECIMAL(20,2) NOT NULL,
    comment VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;
SQL
);

