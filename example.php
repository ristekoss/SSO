<?php

// Include the dependencies
require 'vendor/autoload.php';

// Authenticate the user
SSO\SSO::authenticate();

// At this point, the authentication has succeeded.
// This shows how to get the user details.
$user = SSO\SSO::getUser();
echo $user->name . ' ' . $user->npm . ' ' . $user->role;