<?php
    session_start();
    require_once "../config.php";

    if (isset($_GET['class_id']) && isset($_GET['member_id'])) {
        $class_id = intval($_GET['class_id']);
        $member_id = intval($_GET['member_id']);

        $sql = "DELETE FROM Takes WHERE member_id = ? AND class_id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $member_id, $class_id);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Successfully dropped the class!</p>";
            } else {
                echo "<p>Error dropping the class. Please try again. " . mysqli_error($link) . "</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Error preparing the query: " . mysqli_error($link) . "</p>";
        }
    } else {
        echo "<p>Invalid request. Missing class or member ID.</p>";
    }

    header("Location: index.php");
    exit();
?>