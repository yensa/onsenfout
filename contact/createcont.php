<?php
/**
 * Created by PhpStorm.
 * User: eloria
 * Date: 06/02/18
 * Time: 19:47
 */

require_once '../config.php';
$nom = $prenom = $telbur = $telpor= $mail= $image="";
$nom_err = $prenom_err = $telbur_err= $telpor_err= $mail_err= $image_err= "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "entrez un nom";}
    else{
        $nom = $input_nom;
    }
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = 'entrez votre prenom';
    }
    else{
        $prenom = $input_prenom;}
    $input_telbur = trim($_POST["telbur"]);
    if(empty($input_telbur)){
        $telbur_err = 'entrez votre teléphone de burreau';
    }
    else{
        $telbur = $input_telbur;
    }
    $input_telpor = trim($_POST["telpor"]);
    if(empty($input_telpor)){
        $telpor_err = 'entrez votre teléphone portable';}
    else{
        $telpor = $input_telpor;}
    $input_mail = trim($_POST["mail"]);
    if(empty($input_mail)){
        $mail_err = 'entrez votre mail';}
    else{
        $mail = $input_mail;}
    $input_mail = trim($_POST["mail"]);
    if(empty($input_image)){
        $image_err = 'entrez votre mail';}
    else{
        $image = $input_image;}
    if(empty($nom_err) && empty($prenom_err) && empty($telbur_err) && empty($telpor_err)&& empty($mail_err)){
        $sql = "INSERT INTO contact (nom, prenom, telBur, telPor, mail, image) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssb", $param_nom, $param_prenom, $param_telbur, $param_telpor,$param_mail, $param_image);
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_telbur = $telbur;
            $param_telpor = $telpor;
            $param_mail = $mail;
            $param_image =$image;
            if(mysqli_stmt_execute($stmt)){
                header("location: managecont.php");
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

                    <input type="submit" class="btn btn-primary" value="validé">
                    <a href="managecont.php" class="btn btn-default">anuler</a>
                </form>

        </div>
    </div>
</div>
</body>
</html>