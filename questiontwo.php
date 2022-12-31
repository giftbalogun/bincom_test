<?php
session_start(); 
include('config/db_connect.php');
$polling_uniti = "SELECT * FROM lga";
$polling_result = mysqli_query($conn, $polling_uniti);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <?php if(isset($_SESSION['status'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['status']); } ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4>LGA</h4>
                    </div>
                    <div class="card-body">

                        <form action="questiontwo_submit.php" method="POST">
                            <div class="from-group mb-3">
                                <label for="">LGA</label>
                                <select name="lga" class="form-control">
                                    <option value="">--Select LGA--</option>
                                    <?php while ($polling_row = mysqli_fetch_array($polling_result)):;?>
                                        <option value="<?php echo $polling_row['lga_id']; ?>"><?php echo $polling_row['lga_name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="from-group mb-3">
                                <button type="submit" name="save_select" class="btn btn-primary">Save Selectbox</button>
                            </div>
                        </form>
                    </div>
                        <?php
                        if (isset($_GET['lga_id'])) {
                        $id = $_GET['lga_id'];
                        $sqlq = "SELECT * FROM announced_pu_results AS t1
                        INNER JOIN polling_unit AS t2
                        ON t1.polling_unit_uniqueid = t2.polling_unit_id WHERE lga_id=$id";
                        $query1 = mysqli_query($conn, $sqlq);
                        $sn=1;
                        if (mysqli_num_rows($query1) > 0) {    
                            while($data = mysqli_fetch_assoc($query1)) {
                            ?>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">LGA</th>
                                    <th scope="col">Party Name</th>
                                    <th scope="col">Party Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sn=1;
                                        foreach($query1 as $data) { ?>
                                        <tr>
                                        <th scope="row"><?php echo $sn; $sn++ ?></th>
                                        <td><?php echo $data['polling_unit_name']; ?></td>
                                        <td><?php echo $data['party_abbreviation']; ?></td>
                                        <td><?php echo $data['party_score']; ?></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <?php
                                // $sql2 = "SELECT *, SUM(party_score) AS total_votes FROM announced_pu_results AS t1
                                // INNER JOIN polling_unit AS t2 
                                // ON t1.polling_unit_uniqueid = t2.polling_unit_id WHERE lga_id=$id GROUP BY $id";
                                //$sql2 = "SELECT *, SUM(party_score) AS total_votes FROM announced_pu_results
                                //WHERE lga_name = '$id'
                                //GROUP BY lga_name";
                                //$result2 = mysqli_query($conn, $sql2);
                                $polling_unit_votes = array();
                                while ($row = mysqli_fetch_assoc($query1)) {
                                    if (!isset($polling_unit_votes[$row['polling_unit_id']])) {
                                        $polling_unit_votes[$row['polling_unit_id']] = 0;
                                    }
                                    $polling_unit_votes[$row['polling_unit_id']] += $row['ward_id'];
                                    
                                    // foreach ($polling_unit_votes as $value) {
                                    //     echo $value, "\n";
                                    // }
                                }
                                $total_votes = array_sum($polling_unit_votes);
                                echo '<div class="d-flex justify-content-center">Total Votes: '.$total_votes.'</div>';
                                // if (mysqli_num_rows($result2) > 0) {
                                //     // Output the result
                                //     while($row = mysqli_fetch_assoc($result2)) {
                                //         echo '<div class="d-flex justify-content-center">Total Votes: '.$row["total_votes"].'</div>';
                                //     }
                                // } else {
                                //     echo '<div class="d-flex justify-content-center">Total Votes: 0</div>';
                                // }
                            ?>
                            <?php }}else { ?>
                                <div class="d-flex justify-content-center">No Data Found For LGA</div>
                        <?php } }?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
