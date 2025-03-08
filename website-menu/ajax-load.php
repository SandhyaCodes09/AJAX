<?php
$conn = mysqli_connect("localhost", "root", "", "data_munch") or die("Connection Failed");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql) or die("SQL query failed");

$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                    <th>ID</th>
                    <th>Name & Email</th>
                </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        // Corrected array keys and added double quotes around them
        $output .= "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['user_name']} - {$row['email']}</td>
                    </tr>";
    }

    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
} else {
    echo "<h2>No record found</h2>";
}
?>
