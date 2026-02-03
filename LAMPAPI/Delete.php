<?php

    $inData = getRequestInfo();

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
        $stmt = $conn->prepare("DELETE FROM Contacts WHERE FirstName=? and LastName=? and UserID=?");
        $stmt->bind_param("sss", $firstName, $lastName, $inData["userId"]);
		$stmt->execute();
		
		if( $stmt->affected_rows == 0 )
		{
			returnWithError( "No Contact Deleted" );
		}
		else
		{
			returnWithInfo( "Contact Deleted" );
		}
		
		$stmt->close();
		$conn->close();
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $msg )
	{
		$retValue = '{"message":"' . $msg . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	

?>
