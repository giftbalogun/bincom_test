<?php
session_start();
include('config/db_connect.php');

if(isset($_POST['save_select']))
{
    // Get the form data from the request
    $polling_unit_uniqueid = $_POST["polling_unit_uniqueid"];
    $party = $_POST["party_abbreviation"];
    $votes = $_POST["party_score"];
    $entered_by_user = $_POST["entered_by_user"];
    $date = date('Y-m-d H:i:s');
    $ip_address = gethostbyname("www.google.com");  

    $sql = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address)
    VALUES ('$polling_unit_uniqueid', '$party', '$votes', '$entered_by_user', '$date', '$ip_address')";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        $_SESSION['status'] = "Results Is Updated";
        header("Location: questionthree.php");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: questionthree.php");
    }
}
?>