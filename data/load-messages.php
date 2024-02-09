<?php

include("../connection/conn.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status = $_POST['status'];

    $sql1 = "SELECT comment_id, student_id, message_type, date_added FROM comments_tbl WHERE status=$status";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            $comment_id = $row1['comment_id'];
            $std_id = $row1['student_id'];
            $message_type = $row1['message_type'];
            $date_added = $row1['date_added'];

            $sql2 = "SELECT first_name, last_name, email FROM student_tbl WHERE student_id='$std_id' AND status=1";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $name = $row2['first_name'] . " " . $row2["last_name"];
                $email = $row2['email'];

                echo "<tr>";
                echo "<th>$name</th>";
                echo "<td>$message_type</td>";
                echo "<td>$date_added</td>";

                if ($status == 0) {
                    echo '<td><span class="badge text-bg-danger">Rejected</span></td>';
                } else if ($status == 1) {
                    echo '<td><span class="badge text-bg-success">Accepted</span></td>';
                } else {
                    echo '<td><span class="badge text-bg-warning">Pending</span></td>';
                }


                echo "<th><a href='./show-selected-comment.php?comment_id=$comment_id&status=$status&std_name=$name&std_email=$email' class='btn btn-success btn-sm'>Show</a>&nbsp";
                echo "<a href='../../data/delete-selected-comment.php?comment_id=$comment_id' class='btn btn-danger btn-sm'>Delete</a></th>";
                echo "</tr>";

            }
        }
    } else {
        // no comments
    }
}

?>