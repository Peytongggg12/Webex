<?php
session_start();

function openDatabase() {
    $con = new mysqli("localhost", "root", "", "acmpeyton");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    return $con;
}

function getMemberInfo($conID, &$fName, &$lName, &$deposit, $memberNo) {
    $SQL = "SELECT * FROM member2 WHERE MemberNo = '$memberNo'";
    $result = $conID->query($SQL);

    if (!$result) {
        die("Query Error: " . $SQL . " : " . $conID->error);
    }

    $row = $result->fetch_assoc();

    if (!$row) {
        return false;
    }

    $fName = $row['FirstName'];
    $lName = $row['LastName'];
    $deposit = $row['Deposit'];
    return true;
}

if (!isset($_SESSION['MemberNo'])) {
    header("Location: loginSalt.html?msg=Please login first");
    exit();
}

$memberNo = $_SESSION['MemberNo'];
$fName = "";
$lName = "";
$deposit = "";

$con = openDatabase();
$ok = getMemberInfo($con, $fName, $lName, $deposit, $memberNo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Info Salt</title>
</head>
<body>
  <h2>Greetings Page</h2>

  <?php if ($ok): ?>
    <p><strong>Member No:</strong> <?php echo htmlspecialchars($memberNo); ?></p>
    <p><strong>First Name:</strong> <?php echo htmlspecialchars($fName); ?></p>
    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lName); ?></p>
    <p><strong>Deposit:</strong> <?php echo htmlspecialchars($deposit); ?></p>
  <?php else: ?>
    <p>Member information not found.</p>
  <?php endif; ?>

  <p><a href="logout.php">Logout</a></p>
</body>
</html>