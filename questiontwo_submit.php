<?php
session_start();
include('config/db_connect.php');

if(isset($_POST['save_select']))
{
    $lga = $_POST['lga'];

    // Select the result for the specified polling unit
    $sql = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = '$lga'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($result)
    {
        $_SESSION['status'] = "Result Table Generated";
        header("Location: questiontwo.php?lga_id=$lga");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: questiontwo.php?lga_id=$lga");
    }
}
?>