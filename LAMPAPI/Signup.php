<?php

    $inData = getRequestInfo();

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
    if ($conn->connect_error) {
        returnWithError($conn->connect_error);
    } else {
        $firstName = $inData["firstName"];
        $lastName = $inData["lastName"];
        $login = $inData["login"];
        $password = $inData["password"];

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
        // $hashedPassword = md5($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare(
            "INSERT INTO Users (FirstName, LastName, Login, Password)
                VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $firstName, $lastName, $login, $password); // $hashedPassword
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