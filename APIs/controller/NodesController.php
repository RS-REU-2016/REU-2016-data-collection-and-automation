<?php
	class NodesController {

		public function request($request,$dbh) {
			$method = $request->verb;

			switch($method){
				case 'GET':
					break;
				case 'POST':
					break;
				case 'PUT':
					break;
				case 'DEL':
					break;

				default:
			}
		}

	}
?>