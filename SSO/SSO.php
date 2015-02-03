<?php
/**
 * SSO - Utility library for authentication with SSO-UI
 *
 * @author      Bobby Priambodo <bobby.priambodo@gmail.com>
 * @copyright   2015 Bobby Priambodo
 * @license     MIT
 * @version     1.0.0
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
   * Constructor
   * @param $cas_path The path to the CAS.php. Use only when not installing via composer.
   */
  public function __construct($cas_path = false) {
    // Require CAS.php only if path is provided
    if ($cas_path)
      require $cas_path;

    // Create phpCAS client
    phpCAS::client(CAS_VERSION_2_0, CAS_SERVER_HOST, CAS_SERVER_PORT, CAS_SERVER_URI);

    // Set no validation.
    phpCAS::setNoCasServerValidation();
  }

  /**
   * Authenticate the user.
   *
   * @return bool Authentication
   */
  public function authenticate() {
    return phpCAS::forceAuthentication();
  }

  /**
   * Logout from SSO.
   */
  public function logout() {
    phpCAS::logout();
  }

  /**
   * Returns user's name.
   *
   * @return string Name
   */
  public function getName() {
    return phpCAS::getAttribute('nama');
  }

  /**
   * Returns user's ID (NPM).
   *
   * @return string NPM
   */
  public function getNPM() {
    return phpCAS::getAttribute('npm');
  }

  /**
   * Returns user's role.
   *
   * @return string Role
   */
  public function getRole() {
    return phpCAS::getAttribute('peran_user');
  }

  /**
   * Returns all of user's attributes available.
   *
   * @return array Attributes
   */
  public function getAttributes() {
    return phpCAS::getAttributes();
  }

}