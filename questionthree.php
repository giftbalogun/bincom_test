<?php
session_start(); 
include('config/db_connect.php');

$party = "SELECT * FROM party";
$party_result = mysqli_query($conn, $party);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Polling Unit Data</title>
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
                        <h4>Polling Unit Data</h4>
                    </div>
                    <div class="card-body">

                        <form action="questionthree_submit.php" method="POST">
                            <div class="from-group mb-3">
                                <label for="">Polling Unit Number</label>
                                <input type="text" class="form-control" name="polling_unit_uniqueid"><br>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Party</label>
                                <select name="party_abbreviation" class="form-control">
                                    <option value="">--Select Party--</option>
                                    <?php while ($polling_row = mysqli_fetch_array($party_result)):;?>
                                        <option value="<?php echo $polling_row['partyid']; ?>"><?php echo $polling_row['partyname']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Party Score</label>
                                <input type="text" class="form-control" name="party_score"><br>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Staff Name</label>
                                <input type="text" class="form-control" name="entered_by_user"><br>
                            </div>
                            <div class="from-group mb-3">
                                <button type="submit" name="save_select" class="btn btn-primary">Save Selectbox</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
