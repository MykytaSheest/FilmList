<?php

include 'Core/DB.php';

$db = new Core\DB();

$query = file_get_contents('sql/create_tables.sql');

$db->query($query);
