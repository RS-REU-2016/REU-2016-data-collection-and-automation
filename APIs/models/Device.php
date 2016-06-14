<?php

	class Device {
	public static $tableName = 'railwaycrossing_clients';

		#db columns
		public $id;
		public $node;
		public $mac;
		public $firstseen;
		public $lastseen;
		public $company;

		public function __construct($params){
			$this->node = $params['node'];
			$this->mac = $params['mac'];
			$this->firstseen = $params['firstseen'];
			$this->lastseen = $params['lastseen'];
			$this->company = $params['company'];
		}

		function copyFromRow($row) {
			$this->id = $row['id'];
			$this->node = $row['Node'];
			$this->mac = $row['MAC'];
			$this->firstseen = $row['FirstSeen'];
			$this->lastseen = $row['LastSeen'];
			$this->company = $row['Company'];
		}

		function findByMac($id){
			$stmt = Device::$dbh->prepare("SELECT * FROM ". Device::$tableName. " where id = :id");
			$stmt->bindParam(":id" , $id);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->copyFromRow($row);
		}

		static function findAll() {
			$stmt = Device::$dbh->prepare("SELECT * FROM ". Device::$tableName);
			$stmt->execute();

			$result = array();
			while($row = $stmt->fetch() ){
				$p = new Device();
				$p->copyFromRow($row);
				$reslt[] = $p;
			}
		}

		function save($dbh){
			if(!$this->id) {
				$sql = "INSERT INTO ". Device::$tableName 
					." (Node, MAC, FirstSeen, LastSeen, Company) " 
					." VALUES(?, ?, ?, ?, ?)";

				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(1 , $this->node);
				$stmt->bindParam(2 , $this->mac);
				$stmt->bindParam(3 , $this->firstseen);
				$stmt->bindParam(4 , $this->lastseen);
				$stmt->bindParam(5 , $this->company);
				$stmt->execute();

				$this->id = $dbh->lastInsertId();
			}
		}

	}

?>