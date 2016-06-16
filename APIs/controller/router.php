<?php
	// route the request to the right place
	$controller_name = ucfirst($url_elements[1]) . 'Controller';
	if (class_exists($controller_name)) {
	    $controller = new $controller_name();
	    $result = $controller->$request();
	    print_r($result);
	}
?>