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
		private $link;

		function __construct($host,$user,$pass,$db,$table)
		{
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
			$this->table = $table;

			echo $host;

			$this->link = new mysqli($host,$user,$pass,$db);
			if($this->link->connect_errno)
			{
				echo $this->link->connect_errno;
			}
			else
			{
				$this->Retrieve();
			}
		}

		private function Retrieve()
		{
			$results = array();
			$query = "SELECT * FROM $this->table";
			if($result = $this->link->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					foreach ($row as $value)
					{
						array_push($results, $value);
					}
				}
			}
			print_r($results);
		}
	}
	$Connect = new Connect("localhost","root","NuclearHotdog94","battleoftheschools","werknemers");
?>