<?php
if (isset($_GET["ip_address"])) {
    $btn_id = $_GET["ip_address"];

    $servername = "localhost";
    $username = "intern";
    $password = "Int3rn@cc";
    $dbname = "ip_list";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM list WHERE ip_address = ?");
    $stmt->bind_param("s", $btn_id);

    // Execute the statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Redirect to the ip_table.php page
header("Location: /ip monitoring/");
exit;
?>
