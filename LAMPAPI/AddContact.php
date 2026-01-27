<?php
	$inData = getRequestInfo();
	
	$color = $inData["color"];
	$userId = $inData["userId"];

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (FirstName,LastName,Phone,Email,UserID,DateCreated) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param("ssssss", $inData["fName"], $inData["lName"], $inData["phone"], $inData["email"], $inData["userId"], $inData["dateCreated"]);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	} // missing to account for errors: invalid phone, invalid email, etc.

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
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	

?>

