<?php
// Include the database connection file
require 'db.php';

// Check if the state name is provided via POST
if(isset($_POST['stateName'])) {
    // Sanitize the input to prevent SQL injection
    $stateName = mysqli_real_escape_string($conn, $_POST['stateName']);

    // Prepare the SQL query to fetch commodity data based on the state name
    $sql = "SELECT * FROM commodities WHERE State = '$stateName'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Start building the HTML table rows
        $output = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>";
            $output .= "<td>" . $row['State'] . "</td>";
            $output .= "<td>" . $row['District'] . "</td>";
            $output .= "<td>" . $row['Commodity'] . "</td>";
            // Add more columns as needed
            $output .= "</tr>";
        }
        // Output the HTML table rows
        echo $output;
    } else {
        // If no results are found for the given state
        echo "<tr><td colspan='3'>No commodities found for the given state</td></tr>";
    }
} else {
    // If state name is not provided
    echo "<tr><td colspan='3'>State name not provided</td></tr>";
}
?>
