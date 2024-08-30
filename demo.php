<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<?php

$servername = "localhost";
$username = "intern";
$password = "Int3rn@cc";
$dbname = "ip_list";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

header("refresh: 300");
?>

<body>
    <!-- ========================== PING GRAPH ============================================ -->
    <div class="text-center">
        <hr style="width:100%;text-align:left;margin-left:0">
        <label class="text-secondary" style="font-family: Times New Roman, Times, serif; font-size:20px;">Graph of Ping(ms) for each IP Address</label><br>
        <label style="font-family: Times New Roman, Times, serif; font-size:15px;font-style: italic;">( Here '-1' represent that user in offline )</label>
        <hr style="width:100%;text-align:left;margin-left:0">
    </div>
    <canvas id="myChart" class="pt-5 pb-5" style="width:100%; height: 100%;"></canvas>
    <!-- =========================== IP Table ============================================== -->
    <div class="text-center pt-2">
        <hr style="width:100%;text-align:left;margin-left:0">
        <label class="text-secondary" style="font-family: Times New Roman, Times, serif; font-size:20px;">IP Table</label><br>
        <hr style="width:100%;text-align:left;margin-left:0">
    </div>
    <table class="table table-bordered text-center pt-3" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>IP Address</th>
                <th>IP Name</th>
                <th>Status</th>
                <th>Ping</th>
                <th>Host Name</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM list";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $ip_address = $row["ip_address"];
                    $ping = exec("ping -n 1 $ip_address", $output, $status); // First item in array, since exec returns an array.

                    $ping_time = "N/A"; // Default value if ping fails or output cannot be parsed

                    if ($status == 0) {
                        foreach ($output as $line) {
                            if (preg_match('/Average = (\d+)ms/', $line, $matches)) {
                                $ping_time = $matches[1];

                                //break;
                            }
                        }
                    }

                    $os_info = exec("wmic /node:$ip_address os get caption /value", $os_output);

                    // Parse $os_output to extract OS information
                    $os_name = "Unknown";
                    foreach ($os_output as $line) {
                        if (strpos($line, 'Caption=') !== false) {
                            $os_name = trim(str_replace('Caption=', '', $line));
                            break;
                        }
                    }

                    // echo "$ping_time";

                    $ip_name = $row["ip_name"];
                    $ip_addresses[] = $ip_address;
                    $ping_times[] = $ping_time;
            ?>
                    <!-- ======= Printing Table ======== -->
                    <tr>
                        <td><?php echo "$ip_address" ?></td>
                        <td><?php echo "$ip_name" ?></td>
                        <td>
                            <?php
                            if ($status == 0) {
                                echo '<button class="btn btn-success" style="width: 100%;">Online</button>';
                            } else {
                                echo '<button class="btn btn-danger" style="width: 100%;">Offline</button>';
                            }
                            ?>
                        </td>
                        <td><?php echo "$ping" ?></td>
                        <td>
                            <?php
                            echo "$os_info \n";
                            echo "$os_name \n";
                            echo gethostbyaddr($ip_address);
                            ?>
                        </td>
                        <td>
                            <?php echo "
                                <a class='btn btn-danger btn-sm' href='/ip monitoring/delete.php?ip_address=$row[ip_address]'><i class='fa-solid fa-minus btn btn-danger'></i></a>
                            "; ?>
                        </td>
                    </tr>
                    <!-- ========== END Table ========== -->
            <?php }
            } ?>
        </tbody>
    </table>
    <!-- ======= IP Table END ============================ -->
    <?php
    for ($x = 0; $x < count($ping_times); $x++) {
        if ($ping_times[$x] == "N/A") {
            // echo "The number is: $ping_times[$x] <br>";
            $ping_times[$x] = -1;
            // echo "Updated number is: $ping_times[$x] <br>";
        }
    }
    ?>
    <!-- ================= JS FOR GRAPH ============================= -->
    <script>
        // const barColors = ["red", "green", "blue", "orange", "brown"];
        const barColors = "blue";

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: <?php echo json_encode($ip_addresses); ?>,
                datasets: [{
                    backgroundColor: barColors,
                    data: <?php echo json_encode($ping_times); ?>
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Ping(ms) Vs IP Address"
                }
            }
        });
    </script>
    <!-- ================= GRAPH END ============================= -->
</body>

</html>