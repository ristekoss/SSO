<?php

// Include the dependencies
require 'vendor/autoload.php';

// Instantiate a new SSO object
$sso = new SSO\SSO();

// Authenticate the user
$auth = $sso->authenticate();

// If authentication succeeded, $auth will equal to true.
if ($auth) {
  echo $sso->getName() . ' ' . $sso->getNPM();
}