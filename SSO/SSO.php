<?php
/**
 * SSO - Utility library for authentication with SSO-UI
 *
 * @author      Bobby Priambodo <bobby.priambodo@gmail.com>
 * @copyright   2015 Bobby Priambodo
 * @license     MIT
 * @package     SSO
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace SSO;

use phpCAS;

// ------------------------------------------------------------------------
//  Constants
// ------------------------------------------------------------------------

/**
 * CAS server host address
 */
define('CAS_SERVER_HOST', 'sso.ui.ac.id');

/**
 * CAS server uri
 */
define('CAS_SERVER_URI', '/cas2');

/**
 * CAS server port
 */
define('CAS_SERVER_PORT', 443);

// ------------------------------------------------------------------------
//  CAS Initialization
// ------------------------------------------------------------------------

// ONLY DO THIS IF phpCAS EXISTS (i.e. installing via Composer). Thanks to Fariskhi for noticing the bug.
if (class_exists('phpCAS')) {
  /**
   * Create phpCAS client
   */
  phpCAS::client(CAS_VERSION_2_0, CAS_SERVER_HOST, CAS_SERVER_PORT, CAS_SERVER_URI);

  /**
   * Set no validation.
   */
  phpCAS::setNoCasServerValidation();
}

/**
 * The SSO class is a simple phpCAS interface for authenticating using
 * SSO-UI CAS service.
 *
 * @class     SSO
 * @category  Authentication
 * @package   SSO 
 * @author    Bobby Priambodo <bobby.priambodo@gmail.com>
 * @license   MIT
 */
class SSO
{

  /**
   * Authenticate the user.
   *
   * @return bool Authentication
   */
  public static function authenticate() {
    return phpCAS::forceAuthentication();
  }

  /**
   * Check if the user is already authenticated.
   *
   * @return bool Authentication
   */
  public static function check() {
    return phpCAS::checkAuthentication();
  }

  /**
   * Logout from SSO.
   */
  public static function logout() {
    phpCAS::logout();
  }

  /**
   * Returns the authenticated user.
   *
   * @return Object User
   */
  public static function getUser() {
    $details = phpCAS::getAttributes();

    // Create new user object, initially empty.
    $user = new \stdClass();
    $user->username = phpCAS::getUser();
    $user->name = $details['nama'];
    $user->role = $details['peran_user'];

    if ($user->role === 'mahasiswa') {
      $user->npm = $details['npm'];
      $user->org_code = $details['kd_org'];

      $data = json_decode(file_get_contents( __DIR__ . '/additional-info.json'), true)[$user->org_code];
      $user->faculty = $data['faculty'];
      $user->study_program = $data['study_program'];
      $user->educational_program = $data['educational_program'];
    }
    else if ($user->role === 'staff') {
      $user->nip = $details['nip'];
    }

    return $user;
  }

  // ----------------------------------------------------------
  // Manual Installation Stuff
  // ----------------------------------------------------------

  /**
   * Sets the path to CAS.php. Use only when not installing via Composer.
   *
   * @param string $cas_path Path to CAS.php
   */
  public static function setCASPath($cas_path) {
    require $cas_path;

    // Initialize CAS client.
    self::init();
  }

  /**
   * Initialize CAS client. Called by setCASPath().
   */
  private static function init() {
    // Create CAS client.
    phpCAS::client(CAS_VERSION_2_0, CAS_SERVER_HOST, CAS_SERVER_PORT, CAS_SERVER_URI);

    // Set no validation.
    phpCAS::setNoCasServerValidation();
  }

}