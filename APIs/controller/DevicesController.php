<?php
	require_once('models/DeviceModel.php');

	class DevicesController{

		public function request($request,$dbh) {
			$method = $request->verb;

			switch ($method) {
				case "GET":
					break;
				case "POST":
					$device = new  Device($request->parameters);
					$device->save($dbh);
					return $device;
					break;
				case "PUT":
					break;
				case "DEL":
					break;

				default:
					//should not go here
			}
		}

	}

	
?>