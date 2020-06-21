
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include "../conn.php";

// print_r($_REQUEST);

$q = $_REQUEST["term"];
 
if(isset($q)){

    echo "<div style='min-width:250px; color:black;'>";
    
    if ($_SESSION["Position"]<=1) {
        // Prepare a select statement
        $sql = "SELECT * FROM filme WHERE Titel LIKE '%" . $q ."%';";
        $result = mysqli_query($conn, $sql);

        
        echo "<h4 style='background:lightgray; padding:3px;'>Filmeliste</h4>";
        echo "<div style='padding:10px;'>";
        if(mysqli_num_rows($result) > 0){
            // Fetch result rows as an associative array
            
            while($row = mysqli_fetch_assoc($result)){

                if(mb_detect_encoding($row['Titel']) != 'UTF-8' || 'ASCII') {$row['Titel'] = utf8_encode($row['Titel']);}
                
                echo '<p><a class="nav-link" href="\?cat=filme_verwalten&id=';
                echo $row['FilmID'] . '">';
                echo $row['Titel'];
                echo '</a></p>';
            }
            
        }
        else{
            echo "<p >No matches</p>";
        }
        echo "</div>";

        $sql = "SELECT * FROM saal WHERE Filmberühmtheit LIKE '%" . $q ."%';";
        $result = mysqli_query($conn, $sql);


        echo "<h4 style='background:lightgray;padding:3px;'>Saalliste</h4>";
        echo "<div style='padding:10px;'>";
        if(mysqli_num_rows($result) > 0){
            // Fetch result rows as an associative array
            
            while($row = mysqli_fetch_assoc($result)){

                if(mb_detect_encoding($row['Filmberühmtheit']) != 'UTF-8' || 'ASCII') {$row['Filmberühmtheit'] = utf8_encode($row['Filmberühmtheit']);}
                
                echo '<p><a class="nav-link" href="\?cat=saal_verwalten&id=';
                echo $row['Saal_NR'] . '">';
                echo $row['Filmberühmtheit'];
                echo '</a></p>';
            }
            
        }
        else{
            echo "<p >No matches</p>";
        }
        echo "</div>";
    }

    $sql = "SELECT * FROM reservierung WHERE Vorname LIKE '%" . $q ."%' OR Nachname LIKE '%" . $q ."%';";
    $result = mysqli_query($conn, $sql);


    echo "<h4 style='background:lightgray;padding:3px;'>Reservierungliste</h4>";
    echo "<div style='padding:10px;'>";
    if(mysqli_num_rows($result) > 0){
        // Fetch result rows as an associative array
        
        while($row = mysqli_fetch_assoc($result)){

            if(mb_detect_encoding($row['Vorname']) != 'UTF-8' || 'ASCII') {$row['Vorname'] = utf8_encode($row['Vorname']);}
            if(mb_detect_encoding($row['Nachname']) != 'UTF-8' || 'ASCII') {$row['Nachname'] = utf8_encode($row['Nachname']);}
            

            echo '<p><a class="nav-link" href="\?cat=reservierung_verwalten&id=';
            echo $row['ResNR'] . '">';
            echo $row['Vorname']." ".$row['Nachname'];
            echo '</a></p>';
        }
        
    }
    else{
        echo "<p >No matches</p>";
    }
    echo "</div>";

} else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

echo "</div>";
 


?>