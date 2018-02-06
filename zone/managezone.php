
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>acceuil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">liste des zones</h2>
                        <a href="/zone/createzone.php" class="btn btn-success pull-right">ajouté une zone</a>
                    </div>
                    <?php

                    require_once '/config.php';

                    $sql = "SELECT * FROM zone";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>IDzon</th>";
                                        echo "<th>ville</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['IDzon'] . "</td>";
                                        echo "<td>" . $row['ville'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='/zone/updatezone.php?ID=". $row['IDzon'] ."' title='éditer' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='/zone/deletezone.php?ID=". $row['IDzon'] ."' title='supprimer' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>aucune donnée trouvée.</em></p>";
                        }
                    } else{
                        echo "ERROR: cette opération est impossible $sql. " . mysqli_error($link);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="page-header clearfix">
    <a href="/index.php" class="btn btn-success pull-right">retouner à l'acceuil</a>
</div>
</html>