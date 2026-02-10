<?php

$inData = getRequestInfo();

$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
if ($conn->connect_error) {
    returnWithError($conn->connect_error);
} else {
    $firstName = trim($inData["firstName"] ?? "");
    $lastName  = trim($inData["lastName"] ?? "");
    $login     = trim($inData["login"] ?? "");
    $password  = trim($inData["password"] ?? "");

    // Check for blank fields
    if ($firstName === "" || $lastName === "" || $login === "" || $password === "") {
        returnWithError("All fields are required");
        $conn->close();
        return;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT ID FROM Users WHERE Login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        returnWithError("Username already exists");
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();

    // Hash password
    $hashedPassword = md5($password);

    // Insert new user
    $stmt = $conn->prepare(
        "INSERT INTO Users (FirstName, LastName, Login, Password)
                VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $firstName, $lastName, $login, $hashedPassword); // $hashedPassword
    $stmt->execute();

    $stmt->close();
    $conn->close();

    returnWithError("");
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

?>
