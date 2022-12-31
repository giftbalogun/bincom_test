<?php
session_start();
include('config/db_connect.php');

if(isset($_POST['save_select']))
{
    $polling_unit = $_POST['polling_unit'];

    // Select the result for the specified polling unit
    $sql = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = '$polling_unit'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($result)
    {
        $_SESSION['status'] = "Result Table Generated";
        header("Location: question_one.php?polling_id=$polling_unit");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: question_one.php?polling_id=$polling_unit");
    }
}
?>