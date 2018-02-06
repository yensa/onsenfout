<?php
require_once '../config.php';
$ville = "";
$ville_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_ville = trim($_POST["ville"]);
    if(empty($input_ville)){
        $ville_err = "entrez un nom de ville";}
    else{
        $ville = $input_ville;
    }

    if(empty($ville_err)){
        $sql = "INSERT INTO zone (ville) VALUES (?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_ville);
            $param_ville = $ville;
            if(mysqli_stmt_execute($stmt)){
                header("location: managezone.php");
                exit();
            } else{
                echo "hum c'est enbarassent";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>créer</title>
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
                    <h2>création</h2>
                </div>
                <p>créer un contact</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($ville_err)) ? 'has-error' : ''; ?>">
                        <label>entrez une ville</label>
                        <input type="text" name="ville" class="form-control" value="<?php echo $ville; ?>">
                        <span class="help-block"><?php echo $ville_err;?></span>
                    </div>


                    <input type="submit" class="btn btn-primary" value="validé">
                    <a href="/zone/managezone.php" class="btn btn-default">anuler</a>
                </form>

        </div>
    </div>
</div>
</body>
</html>