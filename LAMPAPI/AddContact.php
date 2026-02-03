<?php
$inData = getRequestInfo();

$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
if ($conn->connect_error) {
	returnWithError($conn->connect_error);
} else {
	
	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$phone = $inData["phone"];
	$email = $inData["email"];
	$userId = $inData["userId"];

	date_default_timezone_set("America/New_York");
	$dateCreated = date("Y-m-d");
	
	if (!validPhone($phone)) returnWithError("Invalid phone number.");
	else if (!validEmail($email)) returnWithError("Invalid email.");
	else {
		$stmt = $conn->prepare("INSERT into Contacts (FirstName,LastName,Phone,Email,UserID,DateCreated) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param("ssssis", $firstName, $lastName, $phone, $email, $userId, $dateCreated);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}
	
}

function getRequestInfo()
{
	return json_decode(file_get_contents('php://input'), true);
}

function sendResultInfoAsJson($obj)
{
	header('Content-type: application/json');
	echo $obj;
}

function returnWithError($err)
{
	$retValue = '{"error":"' . $err . '"}';
	sendResultInfoAsJson($retValue);
}

function validPhone($obj)
{
	if (strlen($obj) != 10) return false;

	for ($i = 0; $i < 10; ++$i) if (!is_numeric($obj[$i])) return false;

	return true;
}

function validEmail($obj)
{
	return filter_var($obj, FILTER_VALIDATE_EMAIL);

}

?>
