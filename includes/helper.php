<?php
//require  NL_INCLUDE_PATH . 'lib/widget.php';
//require  NL_INCLUDE_PATH . 'api/endpoint.php';
$include_files = array(
	//QS_INCLUDE_PATH . 'lib/widget.php',
	QS_INCLUDE_PATH . 'api/endpoint.php',
	//QS_INCLUDE_PATH . 'admin/entry.php',
);
foreach( $include_files  as $include_file ) {
	require_once($include_file);
}


