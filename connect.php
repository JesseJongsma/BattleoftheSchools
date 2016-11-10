<?php
	/**
	* fkn nioce script by Jesse Jongsme
	*/
	class Connect
	{
		private $host;
		private $user;
		private $pass;
		private $db;
		private $table;
		public $link;

		function __construct($host,$user,$pass,$db,$table)
		{
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
			$this->table = $table;

			$this->link = new mysqli($host,$user,$pass,$db);
			if($this->link->connect_errno)
			{
				echo $this->link->connect_errno;
			}
		}

		public function Retrieve()
		{
			$query = "SELECT * FROM $this->table";
			$results = array();

			$i = 0;
			
			if($result = $this->link->query($query))
			{
				while($row = $result->fetch_array(MYSQLI_BOTH))
				{
					foreach ($row as $value)
					{
						array_push($results, $value);
					}
				}
			}
			return $results;
		}

		public function Create($array)
		{
			$count = 0;
			$sql = "'', ";

			foreach ($array as $value)
			{
				if ($count != 0) {
					$sql .= ", ";
				}
				$count ++;

				$sql .= "'$value'";
			}

			$query = "INSERT INTO $this->table VALUES ($sql);";
			if($this->link->query($query))
			{
				echo "successful";
			}
			else
			{
				return $query;
			}
		}

		public function Update($columns, $expressions)
		{
			$count = 0;

			foreach ($array as $value)
			{
				if ($count != 0) {
					$sql .= ", ";
				}
				$count ++;

				$sql .= "'$value'";
			}

			$query = "UPDATE $this->table SET column1 = expression1, column2 = expression2 [WHERE conditions]";
		}

		public function Delete()
		{

		}
	}
	

	
	//print_r($Connect->Retrieve());
	// $array = array("1212", "@.com", "swag");
	// $Connect->Create($array);	
?>