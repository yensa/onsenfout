<?php
require_once '../config.php';
$ville ="";
$ville_err ="";
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    $ID = $_POST["ID"];
    $input_ville = trim($_POST["nom"]);
    if(empty($input_ville)){
        $ville_err = "entrez une ville";
    } else{
        $ville = $input_ville;
    }

    if(empty($ville_err)  ){
        $sql = "UPDATE zone SET ville=? WHERE IDzon=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_ville, $param_ID);
            $param_ville = $ville;
            $param_ID = $ID;
            if(mysqli_stmt_execute($stmt)){
                header("location:managezone.php");
                exit();
            } else{
                echo "humm c'est enbarassant essayez plus tard";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        $ID =  trim($_GET["ID"]);
        $sql = "SELECT * FROM zone WHERE ID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_ID);
            $param_ID = $ID;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $ville = $row["ville"];
                    $age = $row["age"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "NOPE!";
            }
        }
        mysqli_stmt_close($stmt);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2>mise à jour</h2>
                </div>
                <p>edition d'une ville</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($ville_err)) ? 'has-error' : ''; ?>">
                        <label>ville</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo $ville; ?>">
                        <span class="help-block"><?php echo $ville_err;?></span>
                    </div>

                    <input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
                    <input type="submit" class="btn btn-primary" value="validé">
                    <a href="/zone/managezone.php" class="btn btn-default">anuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>