<?php

// Require the required files.
require 'SSO/SSO.php';

// Path to CAS.php, change this to the suitable location.
$cas_path = dirname(__FILE__).'/vendor/jasig/phpcas/CAS.php';

// Instantiate a new SSO object with the given $cas_path
$sso = new SSO\SSO($cas_path);

// Authenticate the user
$auth = $sso->authenticate();

// If authentication succeeded, $auth will equal to true.
if ($auth) {
  echo $sso->getName() . ' ' . $sso->getNPM();
}