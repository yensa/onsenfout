<?php
require_once 'config.php';
$nom = $age = "";
$nom_err = $age_err = "";
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    $ID = $_POST["ID"];
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "entrez un nom";
    } elseif(!filter_var(trim($_POST["nom"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nom_err = 'entrez un nom valide';
    } else{
        $nom = $input_nom;
    }
    $input_age= trim($_POST["age"]);
    if(empty($input_age)){
        $age_err = 'entrez un age';
    } else{
        $age = $input_age;
    }
    if(empty($nom_err) && empty($age_err) ){
        $sql = "UPDATE users SET nom=?, age=? WHERE ID=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sii", $param_nom, $param_age, $param_ID);
            $param_nom = $nom;
            $param_age = $age;
            $param_ID = $ID;
            if(mysqli_stmt_execute($stmt)){
                header("location:index.php");
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
        $sql = "SELECT * FROM users WHERE ID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_ID);
            $param_ID = $ID;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nom = $row["nom"];
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
                    <p>edition d'un user</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                            <label>nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
                            <span class="help-block"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                            <label>age</label>
                            <textarea name="age" class="form-control"><?php echo $age; ?></textarea>
                            <span class="help-block"><?php echo $age_err;?></span>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="validé">
                        <a href="index.php" class="btn btn-default">anuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>