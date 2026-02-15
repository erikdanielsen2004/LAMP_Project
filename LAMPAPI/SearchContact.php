<?php

	$inData = getRequestInfo();
	
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		
		$firstName = "%" . $inData["firstNameSearch"] . "%";
		$lastName = "%" . $inData["lastNameSearch"] . "%";

		//loads all contacts so we dont have to make load contact
		if ($lastName == "%%" && $firstName == "%%") {

			$stmt = $conn->prepare("select FirstName, LastName, Phone, Email from Contacts where UserId=? order by LastName, FirstName");
			$stmt->bind_param("i", $inData["userId"]);

		  //searchs by first name
		} else if ($lastName == "%%") {

			$stmt = $conn->prepare("select FirstName, LastName, Phone, Email from Contacts where FirstName like ? and UserID=? order by LastName, FirstName");
			$stmt->bind_param("si", $firstName, $inData["userId"]);

		  //searchs by last name
		} else if ($firstName == "%%") {

			$stmt = $conn->prepare("select FirstName, LastName, Phone, Email from Contacts where LastName like ? and UserId=? order by LastName, FirstName");
			$stmt->bind_param("si", $lastName, $inData["userId"]);
			
		  //searchs by first and last name
		} else {

			$stmt = $conn->prepare("select FirstName, LastName, Phone, Email from Contacts where (FirstName like ? or LastName like ?) and UserID=? order by LastName, FirstName");
			$stmt->bind_param("ssi", $firstName, $lastName, $inData["userId"]);

		}
		
		$stmt->execute();
		$result = $stmt->get_result();
		
		while($row = $result->fetch_assoc())
		{
			if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}
			$searchCount++;
			$searchResults .= '{"firstName":"' . $row["FirstName"] . '","lastName":"' . $row["LastName"] . '","phone":"' . $row["Phone"] . '","email":"' . $row["Email"] . '"}';
		}
		
		if( $searchCount == 0 )
		{
			returnWithError( "No Records Found" );
		}
		else
		{
			returnWithInfo( $searchResults );
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
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	

?>
