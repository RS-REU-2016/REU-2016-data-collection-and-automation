<?php

	require_once('controllers/DB.php');
	require_once('controllers/DevicesController.php');
	require_once('controllers/NodesController.php');
	require_once('models/DeviceModel.php');
	require_once('models/NodeModel.php');
	require_once('models/RequestModel.php');

	// route the request to the right place
	$request = new Request();
	$controller_name = ucfirst($request->url_elements[1]) . 'Controller';
	
	if (class_exists($controller_name)) {
	    $controller = new $controller_name();
	    $action_name = strtolower($request->verb);
	    $result = $controller->request($request,$dbh);
	    print_r($result);
	}
	


?>