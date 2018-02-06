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
                        <h2 class="pull-left">détail utilisateur</h2>
                        <a href="createcont.php" class="btn btn-success pull-right">ajouté un utilisateur</a>
                    </div>
                    <?php

                    require_once '../config.php';

                    $sql = "SELECT * FROM contact";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>IDcontact</th>";
                                        echo "<th>nom</th>";
                                        echo "<th>prenom</th>";
                                        echo "<th>IDzone</th>";
                                        echo "<th>telbur</th>";
                                        echo "<th>telpor</th>";
                                        echo "<th>mail</th>";
                                        echo "<th>image</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['IDcontact'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['prenom'] . "</td>";
                                        echo "<td>" . $row['IDzone'] . "</td>";
                                        echo "<td>" . $row['telBur'] . "</td>";
                                        echo "<td>" . $row['telPor'] . "</td>";
                                        echo "<td>" . $row['mail'] . "</td>";
                                        echo "<td>" . $row['image'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='updatecont.php?ID=". $row['IDcontact'] ."' title='maj' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?ID=". $row['IDcontact'] ."' title='supprimer' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
</html>