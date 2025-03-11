<?php
$conn = mysqli_connect("localhost", "root", "", "data_munch") or die("Connection Failed");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql) or die("SQL query failed");

$output = "";

if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                    <th width="60px">ID</th>
                    <th>Name & Email</th>
                    <th width="90px">Edit</th>
                    <th width="90px">Delete</th>
                </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        // Corrected array keys and added double quotes around them
        $output .= "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['user_name']} - {$row['email']}</td>
                        <td><button class='edit-btn' data-eid={$row['user_id']} >Edit</button></td>

                        <td><button class='delete-btn' data-id={$row['user_id']} >Delete</button></td>

                    </tr>";

        //In HTML 5 Use the data-* attribute to embed custom data:
    }

    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
} else {
    echo "<h2>No record found</h2>";
}
?>