<?php
class API
{
    private $_params;
     
    public function __construct($params)
    {
        $this->_params = $params;
    }
     
    public function request(){
        
    	swith(strtoupper($this->_params['method'])){
    		case 'GET':
    			break;
    		case 'POST':
    			$newDevice = new Device($this->_params);
    			$newDevice->save();
    			break;
    		case 'UPDATE':
    			break;
    		case 'DELETE':
    			break;
    	}

    }
}