<?php

/*
    spl_autoload_register('apiAutoload');
	function apiAutoload($classname)
	{
	    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
	        include __DIR__ . '/controllers/' . $classname . '.php';
	        return true;
	    } elseif (preg_match('/[a-zA-Z]+Model$/', $classname)) {
	        include __DIR__ . '/models/' . $classname . '.php';
	        return true;
	    } elseif (preg_match('/[a-zA-Z]+View$/', $classname)) {
	        include __DIR__ . '/views/' . $classname . '.php';
	        return true;
	    }
	}
*/
	print_r ($_SERVER)

?>