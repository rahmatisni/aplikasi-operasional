


<style type="text/css">
body {
    color: white;
}

.search-table-outter {
    width: 100%; 
    max-width: 100%;
    margin-left: 0;
    margin-right: auto;
    padding-top: 0;
}
.search-table{
    table-layout: fixed; 
    /* background-color:#1F2739; */
}

.search-table thead tr:nth-child(1){
    color : lightblue;
    /* background : white; */

}

.search-table tr:nth-child(odd) {
    background-color: #323C50;
}

/* Background-color of the even rows */
.search-table tr:nth-child(even) {
    background-color: #2C3446;
}

.search-table, td, th{
    border-collapse:collapse; 
    border-bottom:1px solid white;
    line-height: 10px;
}
th{
    padding:5px 10px; 
    font-size:13px; 
    height:50px;
    line-height: 1;
}

td{
    padding:5px 10px; 
    height:35px;
    
}
.search-table-outter { 
    overflow-x: scroll; 

}
th, td { min-width: 100px; text-align: center;
    line-height: 1;

}

.headcol {
  position: sticky;
  /* width: 5em; */
  left: 0;
  /* top: 0; */
  border-top-width: 1px;
  /*only relevant for first row*/
  /* margin-top: -1px; */
  /*compensate for top border*/
  background-color: #2C3446;

}

.headcol2 {
  position: sticky;
  /* width: 5em; */
  left: 128px;
  top: 0;
  /* border-top-width: 1px; */
  /*only relevant for first row*/
  /* margin-top: -1px; */
  /*compensate for top border*/
  background-color: #2C3446;

}

.headcol3 {
  position: sticky;
  width: 5em;
  left: 0;
  top: 0;
  /* border-top-width: 1px; */
  /*only relevant for first row*/
  /* margin-top: -1px; */
  /*compensate for top border*/
  background-color: #2C3446;

}
/* .headcol:before {
  content: 'Row ';
} */

.fixed {
    position: absolute; 
    left: auto; 
    top: auto;
    background-color: lightblue;
    margin: 1px;
}




.search-table tr :nth-child(1){
    padding-left: 1px;
    /* color : red; */
}
.search-table tr th:nth-child(1) {
    padding-left: 1px;
    /* color : blue; */

}
.search-table tr th{
    padding-left: 1px;
    /* color : blue; */
}
.search-table td:first-child {
    color: yellow;
    /* position: sticky; */
      /* Edge, Chrome, FF */
}

.search-table tr:hover {
background-color: #464A52;
-webkit-box-shadow: 0 6px 6px -6px #0E1119;
    -moz-box-shadow: 0 6px 6px -6px #0E1119;
            box-shadow: 0 6px 6px -6px #0E1119;
}

.search-table td:hover {
background-color: #FFF842;
color: #403E10;
font-weight: bold;

box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
transform: translate3d(6px, -6px, 0);

transition-delay: 0s;
transition-duration: 0.4s;
transition-property: all;
transition-timing-function: line;
}

@media (max-width: 800px) {
.search-table td:nth-child(4),
.search-table th:nth-child(4) { display: none; }
}
</style>

<?php

    $arr_gerbang_id = array();
    $arr_asal_gerbang = array();
    $arr_gol1 = array();
    $arr_gol2 = array();
    $arr_gol3 = array();
    $arr_gol4 = array();
    $arr_gol5 = array();
    $tgl_berlaku = array();
    $id_dasar_tarif = array();

    $someObject = json_decode($fullgerbang);
    $elementCount  = count($someObject);

    for ($i=0; $i<$elementCount; $i++){
        // echo $someObject[$i]->gerbang_nama; // Access Object data
        $servername = $someObject[$i]->host;
        $username =  $someObject[$i]->user;
        $password =  $someObject[$i]->pass;
        $dbname =  $someObject[$i]->database;

        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM tbl_tarif_exit t1 WHERE tgl_berlaku = (SELECT max(tgl_berlaku) from tbl_tarif_exit WHERE gerbang_id = t1.gerbang_id)";
        $result = $conn->query($sql);
        
         if ($result->num_rows > 0) {
                // output data of each row
            while($row = $result->fetch_assoc()) {
                // echo "Gerbang: " . $row["gerbang_id"]."<br>";
                array_push($arr_gerbang_id, $row["gerbang_id"]);
                array_push($arr_asal_gerbang, $row["asal_gerbang"]);
                array_push($tgl_berlaku, $row["tgl_berlaku"]);   
                array_push($id_dasar_tarif, $row["id_dasar_tarif"]);                
             
                array_push($arr_gol1, $row["gol1"]);                
                array_push($arr_gol2, $row["gol2"]);                
                array_push($arr_gol3, $row["gol3"]);                
                array_push($arr_gol4, $row["gol4"]);
                array_push($arr_gol5, $row["gol5"]);                
                

            }
        } else {
            echo "0 results";
        }
    }

    $conn->close();

    $someObject2 = json_decode($namanyagerbang);
    $listdatagerbang = json_decode(json_encode($someObject2), true);
    // print_r(sizeof($listdatagerbang));
    $arraygerbangid = array_values (array_unique($arr_gerbang_id));
    $arraygerbangasal = array_values (array_unique($arr_asal_gerbang));
    // print_r(sizeof($arraygerbangid));
    echo "<br>";
    // print_r(sizeof($arraygerbangasal));

    echo "<br>";
    $new_array = array();
    for ($i = 0; $i <count($arr_gerbang_id); $i++) {
        $new_array[] = array("asal_gerbang"=>"$arr_asal_gerbang[$i]", "gerbang_id"=>"$arr_gerbang_id[$i]", "Gol1"=>"$arr_gol1[$i]", "Gol2"=>"$arr_gol2[$i]", "Gol3"=>"$arr_gol3[$i]", "Gol4"=>"$arr_gol4[$i]", "Gol5"=>"$arr_gol5[$i]", "tgl"=>"$tgl_berlaku[$i]","id_tarif"=>"$id_dasar_tarif[$i]" );   
    }

    $my_arrays = array_unique($new_array, SORT_REGULAR);
    $myArray  = array_values($my_arrays);


    // print_r(sizeof($myArray));
    echo "<br>";


    // for ($i=0; $i<sizeof($myArray); $i++){
    //     print_r("Nama Asal :");
    //     print_r($myArray[$i]['asal_gerbang']);
    //     print_r("Nama Gerbang :");
    //     print_r($myArray[$i]['gerbang_id']);
    //     print_r("Nama Golongan 1 :");
    //     print_r($myArray[$i]['Gol1']);
    //     print_r("Nama Golongan 2 :");
    //     print_r($myArray[$i]['Gol2']);


    //     echo "<br>";
    // }

    // echo '<div class="view">';
    // echo'<div class="wrapper">';
    echo'<div class="container header">';
    echo'<div class="search-table-outter wrapper">';
    echo "<table class='search-table' >";
    $span = sizeof($arraygerbangid);
    echo"<thead>";
        echo '<tr>';
        echo "<th class='headcol'>&nbsp</th>";
        // colspan='".$span."'
        echo "<th class='headcol2'>&nbsp</th>";

        echo "<th font-size: 30px colspan='".$span."' ><h3>GERBANG ASAL</h3></th>";
        echo "</tr>";

        echo '<tr>';
        echo '<th class="headcol"><h3>Gerbang Exit</h3></th>';
        echo '<th class="headcol2"> Golongan </th>';
        
    for ($i = 0; $i<sizeof($arraygerbangid); $i++) { // first loop
        echo '<th>'; 
        for ($x = 0; $x<sizeof($listdatagerbang); $x++) { // first loop
            if ($arraygerbangid[$i] != $listdatagerbang[$x]['gerbang_id']){
                // print_r($arraygerbangid[$i]);
                // print_r($listdatagerbang[$i]['gerbang_id']);
            }
            else {
                print_r($listdatagerbang[$x]['gerbang_nama']);
                print_r("-");
                print_r($listdatagerbang[$x]['gerbang_id']);
            }
        }
        echo '</th>';
    }
        echo "</tr>";
    echo"</thead>";
 


    echo "<tbody>";

    for ($row = 1; $row < sizeof($arraygerbangasal)+1; $row++) { // first loop
        echo "<tr> \n";
        for ($col = 0; $col < sizeof($arraygerbangid)+1; $col++) { //2nd loop
            if($row == 0 && $col == 0){
                echo '<td> Asal Gerbang </td>';
                echo '<td> Golongan </td>';
            }

            else if ($row == 0 && $col != 0)
            {
                
                echo "<td>";
                // print_r(sizeof($listdatagerbang));
                for ($i=0; $i<sizeof($listdatagerbang); $i++){
                    // print_r("x");
                    if ($arraygerbangid[$col-1] != $listdatagerbang[$i]['gerbang_id']){
                    }
                    else {
                        print_r($listdatagerbang[$i]['gerbang_nama']);
                        // print_r ("//");
                        // print_r($listdatagerbang[$i]['gerbang_id']);

                    }


                }
                // print_r(" ".$arraygerbangid[$col-1]);
                echo "</td>";
            }

            else if ($row != 0 && $col == 0)
            {
                
                echo "<td class='headcol'>";
                for ($i=0; $i<sizeof($listdatagerbang); $i++){
                    // print_r("x");
                    if ($arraygerbangasal[$row-1] != $listdatagerbang[$i]['gerbang_id']){
                    }
                    else {
                        print_r($listdatagerbang[$i]['gerbang_nama']);
                        print_r ("=");
                        print_r($listdatagerbang[$i]['gerbang_id']);
                    }


                }

                // print_r($arraygerbangasal[$row-1]);
                echo "</td>";
                echo '<td class="headcol2"> Golongan 1</td>';

            }
            else {
                // $p = $col * $row; //computing values
                if ($arraygerbangid[$col-1] == $arraygerbangasal[$row-1]) {
                    echo "<td>";
                    print_r("ags");
                    echo "</td>";  
                }
                else {

                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($arraygerbangid[$col-1] != $myArray[$i]['gerbang_id'] || $arraygerbangasal[$row-1] != $myArray[$i]['asal_gerbang'])
                        {

                        }
                        else{
                            echo "<td>";
                            // print_r ("x");
                            print_r($myArray[$i]['Gol1'].".000");
                            echo "</td>";
                            break;
                        }
                    }
                        
                }
            }

        }
        echo "</tr>";
        echo '<tr>';
            echo "<th class='headcol'>&nbsp</th>";
            echo '<td class="headcol2"> Golongan 2</td>';

            for ($col = 1; $col < sizeof($arraygerbangid)+1; $col++) { //2nd loop
                // echo "<td>";
                // print_r("ags");
                // echo "</td>";  
                if ($arraygerbangid[$col-1] == $arraygerbangasal[$row-1]) {
                    echo "<td>";
                    print_r("ags");
                    echo "</td>";  
                }
                else {
                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($arraygerbangid[$col-1] != $myArray[$i]['gerbang_id'] || $arraygerbangasal[$row-1] != $myArray[$i]['asal_gerbang'])
                        {
    
                        }
                        else{
                            echo "<td>";
                            // print_r ("x");
                            print_r($myArray[$i]['Gol2'].".000");
                            echo "</td>";
                            break;
                        }
                    }
                        
                }
                
            }
         
        echo '</tr>';
        echo '<tr>';
            echo "<th class='headcol'>&nbsp</th>";
            echo '<td class="headcol2"> Golongan 3</td>';

            for ($col = 1; $col < sizeof($arraygerbangid)+1; $col++) { //2nd loop
                // echo "<td>";
                // print_r("ags");
                // echo "</td>";  
                if ($arraygerbangid[$col-1] == $arraygerbangasal[$row-1]) {
                    echo "<td>";
                    print_r("ags");
                    echo "</td>";  
                }
                else {
                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($arraygerbangid[$col-1] != $myArray[$i]['gerbang_id'] || $arraygerbangasal[$row-1] != $myArray[$i]['asal_gerbang'])
                        {
    
                        }
                        else{
                            echo "<td>";
                            // print_r ("x");
                            print_r($myArray[$i]['Gol3'].".000");
                            echo "</td>";
                            break;
                        }
                    }
                        
                }
                
            }
        echo '</tr>';
        echo '<tr>';
            echo "<th class='headcol'>&nbsp</th>";
            echo '<td class="headcol2"> Golongan 4</td>';
            for ($col = 1; $col < sizeof($arraygerbangid)+1; $col++) { //2nd loop
                // echo "<td>";
                // print_r("ags");
                // echo "</td>";  
                if ($arraygerbangid[$col-1] == $arraygerbangasal[$row-1]) {
                    echo "<td>";
                    print_r("ags");
                    echo "</td>";  
                }
                else {
                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($arraygerbangid[$col-1] != $myArray[$i]['gerbang_id'] || $arraygerbangasal[$row-1] != $myArray[$i]['asal_gerbang'])
                        {
    
                        }
                        else{
                            echo "<td>";
                            // print_r ("x");
                            print_r($myArray[$i]['Gol4'].".000");
                            echo "</td>";
                            break;
                        }
                    }
                        
                }
                
            }
        echo '</tr>';
        echo '<tr>';
            echo "<th class='headcol'>&nbsp</th>";
            echo '<td class="headcol2"> Golongan 5</td>';
            for ($col = 1; $col < sizeof($arraygerbangid)+1; $col++) { //2nd loop
                // echo "<td>";
                // print_r("ags");
                // echo "</td>";  
                if ($arraygerbangid[$col-1] == $arraygerbangasal[$row-1]) {
                    echo "<td>";
                    print_r("ags");
                    echo "</td>";  
                }
                else {
                    for ($i=0; $i<sizeof($myArray); $i++){
                        // print_r("z");
                        if ($arraygerbangid[$col-1] != $myArray[$i]['gerbang_id'] || $arraygerbangasal[$row-1] != $myArray[$i]['asal_gerbang'])
                        {
    
                        }
                        else{
                            echo "<td>";
                            // print_r ("x");
                            print_r($myArray[$i]['Gol5'].".000");
                            echo "</td>";
                            break;
                        }
                    }
                        
                }
                
            }
    echo '</tr>';
    

    }
    echo "</tbody>";

    echo "</table>"; //closing the table

    echo"<'/div'>";
    echo"<'/div'>";

  
    
?>

<script>

$('table').on('scroll', function() {
  $("table > *").width($("table").width() + $("table").scrollLeft());
});
</script>





