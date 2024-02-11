<?php

include("connection/conn.php");

$sql1 = "SELECT 
                c.course_name AS course,
                COUNT(DISTINCT se.student_id) AS num_students
            FROM 
                student_enroll_tbl se
            JOIN 
                course_tbl c ON se.course_id = c.course_id
            JOIN 
                course_type_tbl ct ON c.course_type_id = ct.course_type_id
            WHERE 
                c.course_name IN ('PHP Course for Beginners', 'Python Programming', 'Linux Tutorial for Beginners')
            GROUP BY 
                c.course_name;
            ";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_all();
print_r($row1);

echo "<br>";

print_r($row1[0][0]);