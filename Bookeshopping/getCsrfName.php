<?php
include 'csrfguard.php';

$name="CSRFGuard_".mt_rand(0,mt_getrandmax());
$token=csrfguard_generate_token($name);

echo $name.":".$token;
?>