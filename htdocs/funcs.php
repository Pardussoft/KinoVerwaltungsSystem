<?php

function reserveirungBis($conn, $vorfuhrungID) {
    $sql = "Select datediff(Beginn, Now()) as fark 
            From vorfuhrung 
            Where VorfuhrungID=$vorfuhrungID";

    $result = $conn->query($sql);

    if ($result) { 
        if ($result->num_rows>0) {
            $rec = $result->fetch_assoc();
            return $rec["fark"];
        }
    }

}

function getValue($key, $def) {
    
    if (isset($_GET[$key]))
        return $_GET[$key];
    
    return $def;
}

function postValue($key, $def) {
    
    if (isset($_POST[$key]))
        return $_POST[$key];
    
    return $def;
}

function kayitSayisi($conn, $tablo) {
    $sql ="Select Count(*) as adet from $tablo;";
    $result = $conn->query($sql);
    if ($result) {
        $rec = $result->fetch_assoc();
        return $rec["adet"];
    }
    
    return -1;
}

function kayitSayisiKural($conn, $tablo, $alan, $val) {
    $sql ="Select Count(*) as adet from $tablo Where $alan='$val';";
    $result = $conn->query($sql);
    if ($result) {
        $rec = $result->fetch_assoc();
        return $rec["adet"];
    }
    
    return -1;
}

function kayitStat($conn, $tablo, $alan,$func) {
    $sql ="Select $func($alan) as res from $tablo;";
    $result = $conn->query($sql);
    if ($result) {
        $rec = $result->fetch_assoc();
        return $rec["res"];
    }
    
    return -1;
}


function sayfala($conn, $tablo, $sayfaNo, $kayitSayisi, $cat, $ek="", $class="") {
    
    $kayitAdet = kayitSayisi($conn, $tablo);
    $adet = ceil($kayitAdet/$kayitSayisi);

    if ($adet==0)
        $adet=1;

    $pre= 0;
    $next= 0;

    if ($sayfaNo==1)
        $pre = $adet;
    else
        $pre = $sayfaNo-1;

    if ($sayfaNo == $adet)
        $next = 1;
    else
        $next = $sayfaNo+1;

    $html = "<div class='text-center $class'>";
        $html .= '<ul class="pagination">';
            $html .= "<li><a href='/?cat=$cat&seit_nr=$pre&$ek'>«</a></li>";

            for ($i=1; $i<=$adet; $i++) {
                if ($sayfaNo == $i)
                    $html .= "<li class='active'>"; 
                else
                    $html .= "<li>";
                
                $html .= "<a href='/?cat=$cat&seit_nr=$i&$ek'>$i</a></li>";

            }

            $html .= "<li><a href='/?cat=$cat&seit_nr=$next&$ek'>»</a></li>";
        $html .= '</ul>';
    $html .= '</div>';

   
    return $html;

}

function selectYap($conn, $tablo, $degerAlan, $gosterAlan, $selected, $name, $alle=0, $class="") {

    $sql ="Select $degerAlan, $gosterAlan from $tablo Order By $gosterAlan;";
    $result = $conn->query($sql);

    $html = "<select id='$name' name='$name' class='$class'>";
    if ($alle==1)
        $html .="<option value='alle'>Alle</option>";

    if ($result) {
       
        if ( $result->num_rows>0) {
            while(  $rec = $result->fetch_assoc()   ) {
                $deger= $rec[$degerAlan];
                $goster = $rec[$gosterAlan];
                if ($deger == $selected)
                $html .="<option value='$deger' selected>$goster</option>";
                else
                    $html .="<option value='$deger'>$goster</option>";
            }
        }

        
        
    }

    $html .= "</select>";

    return $html;
}

function selectYapSorgu($conn, $sql, $degerAlan, $gosterAlan, $selected, $name, $class="", $func="") {

  
    $result = $conn->query($sql);

    $html = "<select id='$name' name='$name' class='$class' OnChange='$func'>";
    
    if ($result) {
       
        if ( $result->num_rows>0) {
            while(  $rec = $result->fetch_assoc()   ) {
                $deger= $rec[$degerAlan];
                $goster = $rec[$gosterAlan];
                if ($deger == $selected)
                $html .="<option value='$deger' selected>$goster</option>";
                else
                    $html .="<option value='$deger'>$goster</option>";
            }
        }

        
        
    }

    $html .= "</select>";

    return $html;
}
?>