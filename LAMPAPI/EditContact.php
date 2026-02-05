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

    $id = $inData["id"];

	if (!validPhone($phone)) returnWithError("Invalid phone number.");
	else if (!validEmail($email)) returnWithError("Invalid email.");
	else {
		$stmt = $conn->prepare("UPDATE Contacts SET FirstName=?,LastName=?,Phone=?,Email=? where ID=?");
		$stmt->bind_param("ssssi", $firstName, $lastName, $phone, $email, $id);
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