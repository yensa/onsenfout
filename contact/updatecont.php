<?php
require_once '../config.php';
$nom = $prenom = $telbur = $telpor= $mail= $image="";
$nom_err = $prenom_err = $telbur_err= $telpor_err= $mail_err= $image_err= "";
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    $ID = $_POST["ID"];
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "entrez un nom";
    }else{
        $nom = $input_nom;
    }
    $input_prenom= trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $age_err = 'entrez un prenom';
    } else{
        $prenom = $input_prenom;
    }
    $input_telbur= trim($_POST["telbur"]);
    if(empty($input_telbur)){
        $age_err = 'entrez un téléhpone de burreau';
    } else{
        $telbur = $input_telbur;
    }
    $input_telpor= trim($_POST["telpor"]);
    if(empty($input_telpor)){
        $telpor_err = 'entrez un téléphone portable';
    } else{
        $telpor = $input_telpor;
    }
    $input_mail= trim($_POST["mail"]);
    if(empty($input_mail)){
        $mail_err = 'entrez une adresse mail';
    } else{
        $mail = $input_mail;
    }

    if(empty($nom_err) && empty($prenom_err) && empty($telbur_err) && empty($telpor_err) && empty($mail_err) && empty($image_err) ){
        $sql = "UPDATE users SET nom=?, prenom=?, telBur=?, telPor=?, mail=?, image=? WHERE IDcontact=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sii", $param_nom, $param_prenom,$param_telbur,$param_telpor,$param_mail,$param_image =$image, $param_ID);
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_telbur = $telbur;
            $param_telpor = $telpor;
            $param_mail = $mail;
            $param_image =$image;
            $param_ID = $ID;
            if(mysqli_stmt_execute($stmt)){
                header("location:../index.php");
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
        $sql = "SELECT * FROM contact WHERE IDcontact = ?";
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
                    <div class="form-group <?php echo (!empty($prenom_err)) ? 'has-error' : ''; ?>">
                        <label>prenom</label>
                        <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>">
                        <span class="help-block"><?php echo $prenom_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($telbur_err)) ? 'has-error' : ''; ?>">
                        <label>téléphone de bureau</label>
                        <input type="text" name="telbur" class="form-control" value="<?php echo $telbur; ?>">
                        <span class="help-block"><?php echo $telbur_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($telpor_err)) ? 'has-error' : ''; ?>">
                        <label>téléphone portable</label>
                        <input type="text" name="telpor" class="form-control" value="<?php echo $telpor; ?>">
                        <span class="help-block"><?php echo $telpor_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                        <label>mail</label>
                        <input type="text" name="mail" class="form-control" value="<?php echo $mail; ?>">
                        <span class="help-block"><?php echo $mail_err;?></span>
                    </div>
                    <div  class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                        <label>Select image to upload:</label>
                        <input type="file" name="image" value="<?php echo $image; ?>">
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