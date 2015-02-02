<?php

require 'vendor/autoload.php';

$sso = new SSO\SSO();
$auth = $sso->authenticate();

if ($auth) {
  echo $sso->getName() . '<br>';
  echo $sso->getNPM();
}