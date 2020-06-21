<?php 

?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="info-box blue-bg">
        <i class="fa fa-film"></i>
        <a href="\?cat=filme_zeigen">
            <div class="count"><?echo kayitSayisi($conn, "filme");?></div>
            <div class="title">Filme</div>
        </a>
    </div>
    <!--/.info-box-->
    </div>
    <!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="info-box brown-bg">
        <i class="fa fa-map-marker"></i>
        <a href="\?cat=saal_liste">
            <div class="count"><?echo kayitSayisi($conn, "saal");?></div>
            <div class="title">Sale</div>
        </a>
    </div>
    <!--/.info-box-->
    </div>
    <!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="info-box dark-bg">
        <i class="fa fa-euro"></i>
        <a href="\?cat=verkauf_liste">
            <div class="count"><?echo kayitSayisi($conn, "verkauf");?> / <?echo kayitStat($conn, "eintrittskarte","Preis","Sum");?>€</div>
            <div class="title">Verkauf</div>
        </a>
    </div>
    <!--/.info-box-->
    </div>
    <!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="info-box green-bg">
        <i class="fa fa-cubes"></i>
        <a href="\?cat=reserveirung_liste">
            <div class="count"><?echo kayitSayisi($conn, "reservierung");?></div>
            <div class="title">Reserveirung</div>
        </a>
    </div>
    <!--/.info-box-->
    </div>
    <!--/.col-->

</div>
<!--/.row-->





<!-- Today status end -->



<div class="row">

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><i class="fa fa-flag-o red"></i><strong>Vorfuhrung</strong></h2>
            <div class="panel-actions">
               
            </div>
        </div>
        <div class="panel-body" style='overflow:auto; width:100%; max-height:500px;'>
            <table class="table bootstrap-datatable vorfuhrungs">
                <thead>
                <tr>
                    <th></th>
                    <th>Filme</th>
                    <th>Saal</th>
                    <th>Zeit</th>
                    <th>Fülle</th>
                </tr>
                </thead>
                <tbody>
        
                    <?php


                    $sql = "SELECT
                                vorfuhrung.*,
                                saal.*,
                                filme.Titel,
                                filme.Bild,
                                filme.FilmID
                            FROM
                                vorfuhrung
                            INNER JOIN saal ON vorfuhrung.Saal_NR = saal.Saal_NR
                            INNER JOIN filme ON vorfuhrung.FilmID = filme.FilmID
                            ORDER BY filme.titel, vorfuhrung.Beginn, vorfuhrung.Ende";


                        //echo $sql;
                        $result = $conn->query($sql);

                        if ($result) {
                            if ($result->num_rows>0) {

                                while ($rec = $result->fetch_assoc()) {
                                    $vorfuhrungID= $rec["VorfuhrungID"];
                                    $beginn = $rec["Beginn"];
                                    $ende = $rec["Ende"];
                                    $filmberühmtheit=$rec["Filmberühmtheit"];
                                    $film = $rec["Titel"];
                                    $filmID=$rec["FilmID"];
                                    $saal_nr = $rec["Saal_NR"];
                                    $bild=$rec["Bild"];
                                    $oran =round(kayitSayisiKural($conn,"eintrittskarte","VorfuhrungID",$vorfuhrungID) / kayitSayisiKural($conn,"sitzplatz","Saal_NR",$saal_nr)*100);

                                    if ($bild=="")
                                        $bild="default.png";

                                ?>

                                <tr Onclick="yonlendir('\?cat=verkauf_hinzufuegen&<?php echo "film=$filmID&vorfuhrung=$vorfuhrungID"; ?>');">
                                    <td><img src='img/filme/<?php echo $bild; ?>' width='50' height='50'/></td>
                                    <td><?php echo $film; ?></td>
                                    <td><?php echo $filmberühmtheit; ?></td>
                                    <td><?php echo $beginn." <b>-</b> ".$ende ?></td>
                                    <td>
                                    <div class="progress thin">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $oran;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $oran;?>%">
                                        </div>
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo 100-$oran;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (100-$oran);?>%">
                                        </div>
                                    </div>
                                    <span class="sr-only"><?php echo $oran;?>%</span>
                                    </td>
                                </tr>

                                <?php
                                }
                            }

                        }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

