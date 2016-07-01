<?php

require_once('session.php');
 
start_session();
try_to_logout();
destroy_session();

$header_path = $_SERVER["DOCUMENT_ROOT"].$_SERVER["REQUEST_URI"];
header("Location: " . $header_path);
//header("Location: /index.php");
//header($header_path);