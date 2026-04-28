<?php
session_start();

function openDatabase() {
    $con = new mysqli("localhost", "root", "", "acmpeyton");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}

function pwOK($conID, $uName1, $pw1, &$memberNo1) {
    $SQL = "SELECT * FROM memberpw2 WHERE UserName = '$uName1'";
    $result = $conID->query($SQL);

    if (!$result) {
        die("Query Error: " . $SQL . " : " . $conID->error);
    }

    $row = $result->fetch_assoc();

    if (!$row) {
        return false;
    }

    $memberNo1 = $row['MemberNo'];
    $hpw = $row['PassWord'];
    $salt = $row['Salt'];

    if ($hpw != sha1($pw1 . $salt)) {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uName = $_POST['uName'] ?? '';
    $pw = $_POST['pw'] ?? '';

    $con = openDatabase();
    $memberNo = 0;

    if (pwOK($con, $uName, $pw, $memberNo)) {
        $_SESSION['MemberNo'] = $memberNo;
        header("Location: memberInfoSalt.php");
        exit();
    } else {
        header("Location: loginSalt.html?msg=Wrong username or password");
        exit();
    }
}
?>