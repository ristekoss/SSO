<?php

// Require the required files.
require 'SSO/SSO.php';

// Path to CAS.php, make sure to change this to the suitable location.
$cas_path = dirname(__FILE__).'/vendor/jasig/phpcas/CAS.php';

// Set the CAS path.
SSO\SSO::setCASPath($cas_path);

// Authenticate the user
SSO\SSO::authenticate();

// At this point, the authentication has succeeded.
// This shows how to get the user details.
$user = SSO\SSO::getUser();

if ($user->role === 'mahasiswa')
	echo $user->username . ' ' . $user->name . ' ' . $user->npm . ' ' . $user->role . ' ' . $user->faculty . ' ' . $user->study_program . ' ' . $user->educational_program;
else if ($user->role === 'staff')
	echo $user->username . ' ' . $user->name . ' ' . $user->nip . ' ' . $user->role;