<?php
$ip_validation = $name_validation = "";

$servername = "localhost";
$username = "intern";
$password = "Int3rn@cc";
$dbname = "ip_list";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['insert'])) {
    if (empty($_POST["ip_address"])) {
        $ip_validation = "IP Address can't be empty!";
    } else if (empty($_POST["ip_name"])) {
        $name_validation = "IP Name field can't be empty!";
    } else {
        $ip_address = $_POST["ip_address"];
        if (filter_var($ip_address, FILTER_VALIDATE_IP)) {
            $ip_name = $_POST["ip_name"];
            $stmt = $conn->prepare("INSERT INTO list (ip_address, ip_name) VALUES (?, ?)");
            // Bind parameters
            $stmt->bind_param("ss", $ip_address, $ip_name);
            $stmt->execute();
            $stmt->close();
            $ip_validation = $name_validation = "";
        } else {
            $ip_validation = "IP Address not a valid!";
        }
    }
}
?>
<section>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row">
            <div class="col-md-5 pb-3 pt-3">
                <label class="fw-bold pb-2">IP Address : <span class="text-danger"><?php echo "$ip_validation" ?></span></label>
                <input type="text" class="form-control" placeholder="IP Address" name="ip_address">
            </div>
            <div class="col-md-6 pb-3 pt-3">
                <label class="fw-bold pb-2">IP Name : <span class="text-danger"><?php echo "$name_validation" ?></span></label>
                <input type="text" class="form-control" placeholder="IP Name" id="ip_name" name="ip_name">
            </div>
            <div class="col-md-1 pb-3 pt-5"> 
                <input type="submit" style="width: 100%;" class="btn btn-success" name="insert" value="Insert"></input>
            </div>
        </div>
    </form>
</section>
<section class="pt-5">
    <?php include 'ip_table.php'; ?>
</section>