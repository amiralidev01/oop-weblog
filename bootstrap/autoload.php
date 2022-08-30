<?php



// Start a Session
if (!session_id()) @session_start();
require_once 'app/functions.php';
require 'vendor/autoload.php';

$flash = new \Plasticbrain\FlashMessages\FlashMessages();