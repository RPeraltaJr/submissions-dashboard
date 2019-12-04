<?php 

$query = "CREATE TABLE `$submissions_table` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- `first_name` varchar(50) NOT NULL,
    -- `last_name` varchar(50) NOT NULL,
    -- `phone` varchar(30) NOT NULL,
    -- `email` varchar(60) NOT NULL,
    -- `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

maybe_create_table($submissions_table, $query);