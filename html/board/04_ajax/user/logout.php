<?php

require_once('session.php');
 
start_session();
$request_uri = $_SESSION['request_uri'];

try_to_logout();
destroy_session();			
header("Location: " . $request_uri);
//header("Location: /index.php");
//header($header_path);