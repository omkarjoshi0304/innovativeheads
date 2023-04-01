

<?php

function getTotalPresentCount($tableName) {
    // Establish a connection to the MySQL database
   require('db_connect.php');

    // Get the list of column names from the table metadata
    $result = $conn->query("SHOW COLUMNS FROM $tableName");
    $columns = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $columnName = $row["Field"];
            if (substr($columnName, 0, 1) === "L") {
                $columns[] = $columnName;
            }
        }
        $TC = count($columns);
    } else {
        echo "Error: No columns found in table '$tableName'";
        exit();
    }

    // Construct the SQL query
    $sql = "SELECT ";
    $caseStatements = array();
    foreach ($columns as $column) {
        $caseStatements[] = "(CASE WHEN $column = 'present' THEN 1 ELSE 0 END)";
    }
    
    $sqltest = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if (mysqli_num_rows($sqltest) > 0) {
        $row = mysqli_fetch_assoc($sqltest);
    }
    $name = $row['fname'];

    $sql .= implode(" + ", $caseStatements) . " AS total_present FROM $tableName WHERE name = '$name' LIMIT 1";

    // Execute the query and handle errors
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // Display the results
        if ($result->num_rows > 0) {
            // Output data of the first row
            while($row = $result->fetch_assoc()) {
                $TPC = $row["total_present"];
                $per = ($TPC / $TC * 100);
                $resultArray = array("TPC" => $TPC, "TC" => $TC, "percentage" => $per);
                return $resultArray;
            }
        } else {
            echo "0 results";
        }
    }

    // Close the database connection
    $conn->close();
}

$mathsResult = getTotalPresentCount("maths");
$mathsTPC = $mathsResult["TPC"];
$mathsTC = $mathsResult["TC"];
$mathsPercentage = $mathsResult["percentage"];

$physicsResult = getTotalPresentCount("physics");
$physicsTPC = $physicsResult["TPC"];
$physicsTC = $physicsResult["TC"];
$physicsPercentage = $physicsResult["percentage"];

$chemistryResult = getTotalPresentCount("chemistry");
$chemistryTPC = $chemistryResult["TPC"];
$chemistryTC = $chemistryResult["TC"];
$chemistryPercentage = $chemistryResult["percentage"];

$beeResult = getTotalPresentCount("bee");
$beeTPC = $beeResult["TPC"];
$beeTC = $beeResult["TC"];
$beePercentage = $beeResult["percentage"];

$emaResult = getTotalPresentCount("ema");
$emaTPC = $emaResult["TPC"];
$emaTC = $emaResult["TC"];
$emaPercentage = $emaResult["percentage"];

