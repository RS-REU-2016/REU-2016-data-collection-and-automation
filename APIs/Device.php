<?php

	class Device {
	public static $tableName = 'Clients';
	public static $dbh = 'REU2016'

		#db columns
		public $id;
		public $Node;
		public $MAC;
		public $FirstSeenD;
		public $FirstSeenT;
		public $LastSeenD;
		public $LastSeenT;

		function copyFromRow($row) {
			$this->id = row['id'];
			$this->node = row['Node'];
			$this->mac = row['MAC'];
			$this->firstseenDate = row['FirstSeenD'];
			$this->firstseenTime = row['FirstSeenT'];
			$this->lastseenDate = row['LastSeenD'];
			$this->LastSeenTime = row['LastSeenT'];
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

		function save(){
			if(!$this->id) {
				$sql = "INSERT INTO ". Device::$tableName 
					." (Node, MAC, FirstSeenD, FirstSeenT, LastSeenD, LastSeenT) " 
					." VALUES(?, ?, ?, ?, ?, ?)";

				$stmt = Device::$dbh->prepare($sql);
				$stmt->bindParam(1 , $this->node);
				$stmt->bindParam(2 , $this->mac);
				$stmt->bindParam(3 , $this->firstseenDate);
				$stmt->bindParam(4 , $this->firstseenTime);
				$stmt->bindParam(5 , $this->lastseenDate);
				$stmt->bindParam(6 , $this->lastseenTime);
				$stmt->execute();

				$this->id = $dbh->lastInsertId();
			}
		}

	}

?>