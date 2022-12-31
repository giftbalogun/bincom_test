<?php
session_start();
include('config/db_connect.php');

if(isset($_POST['save_select']))
{
    $lga = $_POST['lga'];

    $query1 = "SELECT * FROM lga WHERE lga_id = '$lga'";
    $result = mysqli_query($conn, $query1);
    while ($row = mysqli_fetch_assoc($result)) {
      $lganame = $row['lga_name'];
    }

    if($result)
    {
        $_SESSION['status'] = "Result Table Generated";
        header("Location: questiontwo.php?lga_id=$lga&lga_name=$lganame");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: questiontwo.php?lga_id=$lga");
    }
}
?>