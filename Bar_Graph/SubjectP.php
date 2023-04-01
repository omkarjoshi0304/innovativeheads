<?php

function getTotalPresentCount($tableName) {
    // Establish a connection to the MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatapp";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
    $sql .= implode(" + ", $caseStatements) . " AS total_present FROM $tableName WHERE name = 'Omkar' LIMIT 1";

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
				$per=($TPC/$TC*100);
				return $per;
            }
        } else {
            echo "0 results";
        }
    }

    // Close the database connection
    $conn->close();
}

$maths=getTotalPresentCount("maths");
$Physics=getTotalPresentCount("physics");
$Chemistry=getTotalPresentCount("chemistry");
$Bee=getTotalPresentCount("bee");

$Ema=getTotalPresentCount("ema");


?>
