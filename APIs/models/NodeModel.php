<?php

	class Node {
	public static $tableName = 'DEVICES';

		#db columns
		public $id;
		public $mac;
		public $desc;

		public function __construct($params){
			$this->mac = $params['MAC'];
			$this->desc = $params['DESC'];
		}

		function copyFromRow($row) {
			$this->id = $row['id'];
			$this->mac = $row['MAC'];
			$this->desc = $row['DESC'];
		}

		function findByMac($id){
			$stmt = Node::$dbh->prepare("SELECT * FROM ". Node::$tableName. " where id = :id");
			$stmt->bindParam(":id" , $id);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->copyFromRow($row);
		}

		static function findAll() {
			$stmt = Node::$dbh->prepare("SELECT * FROM ". Node::$tableName);
			$stmt->execute();

			$result = array();
			while($row = $stmt->fetch() ){
				$p = new Node();
				$p->copyFromRow($row);
				$reslt[] = $p;
			}
		}

		function save($dbh){
			if(!$this->id) {
				$sql = "INSERT INTO ". Node::$tableName 
					." (MAC, DESC) " 
					." VALUES(?, ?)";

				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(1 , $this->mac);
				$stmt->bindParam(2 , $this->desc);
				$stmt->execute();

				$this->id = $dbh->lastInsertId();
			}
		}

	}

?>