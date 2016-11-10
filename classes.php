<?php
class database
{
	function databaseConnect()
	{
		global $conn;

		$conn = new mysqli("localhost", "root", "", "bos");
		if ($conn->connect_error) {
		    ?>
		    	<form action='Home.php' name="GoBackToHome" method='post'>
					<input type='submit' value='Go Back' />
				</form>
				<?php
		    die ("<b>Error Message:</b> Failed to connect with the database.");
		}
	}
	function retrieveData($tabelName)
	{
		global $conn;
		
		$sql = "SELECT * FROM $tabelName";
		$result = $conn->query($sql);
		
		return $result;
	}
	function retrieveCheckIfExists($tabelName, $wnemerID)
	{
		global $conn;
		
		$sql = "SELECT comp_id FROM $tabelName WHERE wnemer_id = $wnemerID";
		$result = $conn->query($sql);
		
		return $result;
	}
	function saveSettingsData($arraySaveData)
	{
		global $conn;

    	$sqlTruncate = "TRUNCATE TABLE wnemer_comp;";
		$conn->query($sqlTruncate);

        foreach ($arraySaveData as $key => $value) 
        {
    		if ($value == true)
    		{
	    		$sqlSave = "INSERT INTO wnemer_comp SET comp_id = '$key', wnemer_id = '1';";
				$conn->query($sqlSave);	
			}
		}	
	}
}
