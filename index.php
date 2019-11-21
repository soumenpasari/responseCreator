<?php
/**
 * @author Soumen Pasari
 * @package ResponseCreator
 */
# error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * This page is for testing the results
 */
require_once('autoload.php');

// ResponseCreator::success('test','testing',200,'data');
// ResponseCreator::error('master','testing 2');
ResponseCreator::merge('test');
echo '<pre>';
print_r(ResponseCreator::getResponse());