<?php
class database
{
	function databaseConnect()
	{
		global $conn;

		$conn = new mysqli("localhost", "root", "root", "bos");
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
	function saveEigenschappenData($arraySaveData)
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
	function retrieveDataFromUser($tabelName, $wnemerID)
	{
		global $conn;
		
		$sql = "SELECT * FROM $tabelName WHERE id = $wnemerID";
		$result = $conn->query($sql);
		
		return $result;		
	}
	function saveAccountSettingsData($arraySaveAccountSettingsData)
	{
		global $conn;
		
		$sqlSave = "UPDATE werknemers SET ";

        foreach ($arraySaveAccountSettingsData as $key => $value) 
        {
    		$sqlSave = $sqlSave . "$key = '$value', ";
		}
		
		$sqlSave = substr($sqlSave, 0, -2);
		$sqlSave = $sqlSave . " WHERE id = '1';";
		//echo $sqlSave;
		$conn->query($sqlSave);	
	}
}
