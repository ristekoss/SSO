<?php

// Include the dependencies
require 'vendor/autoload.php';

// Authenticate the user
SSO\SSO::authenticate();

// At this point, the authentication has succeeded.
// This shows how to get the user details.
$user = SSO\SSO::getUser();

if ($user->role === 'mahasiswa')
	echo $user->username . ' ' . $user->name . ' ' . $user->npm . ' ' . $user->role . ' ' . $user->faculty . ' ' . $user->study_program . ' ' . $user->educational_program;
else if ($user->role === 'staff')
	echo $user->username . ' ' . $user->name . ' ' . $user->nip . ' ' . $user->role;