<?php
session_start();

function openDatabase() {
    $con = new mysqli("localhost", "root", "", "acmpeyton");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}

function usernameTaken($conID, $uName) {
    $sql = "SELECT * FROM memberpw2 WHERE UserName = '$uName'";
    $result = $conID->query($sql);
    return ($result && $result->num_rows > 0);
}

function writeRecord($conID, $fName, $lName, $eMail, $uName, $pw, $deposit) {
    $salt = bin2hex(random_bytes(16));
    $hashed_password = sha1($pw . $salt);

    $sql1 = "INSERT INTO memberpw2 (UserName, PassWord, eMail, Salt)
             VALUES ('$uName', '$hashed_password', '$eMail', '$salt')";

    if ($conID->query($sql1) !== TRUE) {
        echo "Error: " . $sql1 . "<br>" . $conID->error;
        return false;
    }

    $lastMemberNo = $conID->insert_id;

    $sql2 = "INSERT INTO member2 (MemberNo, FirstName, LastName, Deposit)
             VALUES ('$lastMemberNo', '$fName', '$lName', '$deposit')";

    if ($conID->query($sql2) !== TRUE) {
        echo "Error: " . $sql2 . "<br>" . $conID->error;
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = $_POST['fName'] ?? '';
    $lName = $_POST['lName'] ?? '';
    $eMail = $_POST['eMail'] ?? '';
    $uName = $_POST['uName'] ?? '';
    $pw = $_POST['pw'] ?? '';
    $deposit = $_POST['deposit'] ?? '';

    $con = openDatabase();

    if (usernameTaken($con, $uName)) {
        header("Location: registerSalt.html?msg=Username already taken");
        exit();
    }

    if (writeRecord($con, $fName, $lName, $eMail, $uName, $pw, $deposit)) {
        header("Location: loginSalt.html?msg=Registration successful");
        exit();
    } else {
        header("Location: registerSalt.html?msg=Registration failed");
        exit();
    }
}
?>