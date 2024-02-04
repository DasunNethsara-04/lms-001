<?php
include("../connection/conn.php");
$playlist = $_POST['playlist'];

$sql = "SELECT lesson_number, lesson_name FROM lesson_tbl WHERE course_id='$playlist'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <th>
                <?= $row['lesson_number'] ?>
            </th>
            <td>
                <?= $row['lesson_name'] ?>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
    <td colspan="2">
        <div class="alert alert-warning text-center" role="alert">
            <b>No videos uplaoded for this playlist</b>
        </div>
    </td>
    <?php
}

$conn->close();

?>