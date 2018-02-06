<?php
/**
 * Created by PhpStorm.
 * User: eloria
 * Date: 06/02/18
 * Time: 20:31
 */

if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    require_once '../config.php';
    $sql = "DELETE FROM contact WHERE IDcontact = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_ID);
        $param_ID = trim($_POST["ID"]);
        if(mysqli_stmt_execute($stmt)){
            header("location: managecont.php");
            exit();
        } else{
            echo "ou pas";
        }}
    mysqli_stmt_close($stmt);
} else{
    if(empty(trim($_GET["ID"]))){
        header("location: error.php");
        exit();
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>suppression</title>
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
                        <h1>sup utilisateur</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="ID" value="<?php echo trim($_GET["IDcontact"]); ?>"/>
                            <p>vous étes sur ?</p><br>
                            <p>
                                <input type="submit" value="oui" class="btn btn-danger">
                                <a href="managecont.php" class="btn btn-default">Non</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>