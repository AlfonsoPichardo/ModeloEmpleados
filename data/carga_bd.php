<?php

$db = new PDO('sqlite:' . realpath(__DIR__) . '/employees.db');
$fh = fopen(__DIR__ . '/esquemas.sql', 'r');
while ($line = fread($fh, 4096)) {
    $db->exec($line);
}
fclose($fh);

?>