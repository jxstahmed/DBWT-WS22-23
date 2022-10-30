<?php
/**
 * Praktikum DBWT. Autoren:
 * Ahmed, Jumaa
 * Mohammed, Hammado
 */

$fp = fopen('accesslog.txt', 'a');

$txt = date("d.m.Y h:i") . " | " . $_SERVER['HTTP_USER_AGENT'] . " | " . $_SERVER['REMOTE_ADDR'];
$txt = $txt . "\n";

fwrite($fp, $txt);
fclose($fp);
