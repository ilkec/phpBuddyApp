<?php 
include_once(__DIR__ . '/classes/User.php');

$user = new User();
 $api = 'SENDGRID_API_KEY=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';
$user->setApi($api);
?>