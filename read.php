<?php
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    require_once 'config.php';
    $sql = "SELECT * FROM contact WHERE IDcontact = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_ID);
        $param_ID = trim($_GET["ID"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $IDcontact=$row['IDcontact'];
                $nom=$row['nom'];
                $prenom=$row['prenom'];
                $IDzone=$row['IDzone'];
                $telBur=$row['telBur'];
                $telPor=$row['telPor'];
                $mail =$row['mail'];
                $image =$row['image'];
            } else{
                header("location: error.php");
                exit();}
        } else{
            echo "marche pas";}}
    mysqli_stmt_close($stmt);
} else{
    header("location: error.php");
    exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>voir</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>voir un utilisateur</h1>
                    </div>
                    <div class="form-group">
                        <label>nom</label>
                        <p class="form-control-static"><?php echo $nom; ?></p>
                    </div>
                    <div class="form-group">
                        <label>prenom</label>
                        <p class="form-control-static"><?php echo $prenom; ?></p>
                    </div>
                    <div class="form-group">
                        <label>IDzone</label>
                        <p class="form-control-static"><?php echo $IDzone; ?></p>
                    </div>
                    <div class="form-group">
                        <label>tel burreau</label>
                        <p class="form-control-static"><?php echo $telBur; ?></p>
                    </div>
                    <div class="form-group">
                        <label>tel protable</label>
                        <p class="form-control-static"><?php echo $telPor; ?></p>
                    </div>
                    <div class="form-group">
                        <label>mail</label>
                        <p class="form-control-static"><?php echo $mail; ?></p>
                    </div>
                    <div class="form-group">
                        <label>image</label>
                        <p class="form-control-static"><?php echo $image; ?></p>
                    </div>
                    <p><a href="/index.php" class="btn btn-primary">revenir en arriére</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>