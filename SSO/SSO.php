<?php

namespace SSO;

use phpCAS;

define('CAS_SERVER_HOST', 'sso.ui.ac.id');
define('CAS_SERVER_URI', '/cas2');
define('CAS_SERVER_PORT', 443);

class SSO
{

  public function __construct() {
    phpCAS::client(CAS_VERSION_2_0, CAS_SERVER_HOST, CAS_SERVER_PORT, CAS_SERVER_URI);
  }

  public function authenticate() {
    return phpCAS::forceAuthentication();
  }

  public function logout() {
    phpCAS::logout();
  }

  public function getName() {
    return phpCAS::getAttribute('nama');
  }

  public function getNPM() {
    return phpCAS::getAttribute('npm');
  }

  public function getAttributes() {
    return phpCAS::getAttributes();
  }

}