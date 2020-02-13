<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once root.'/function/db.php';
require_once root.'/function/function.php';
if (isset($_COOKIE['lang'])){
    if($_COOKIE['lang']=='ru'){
        $dataLoad = loadRu('ru');
    }else{
        $dataLoad = loadRu('he');
    }
}else if(empty($_COOKIE['lang'])){
    $dataLoad = loadRu('ru');
}
$db = new db();

$sql = "SELECT DISTINCT `Section` FROM `alldata` WHERE section>0 ORDER BY Section;";
if($query=$db->con->query($sql)){
    $j = 0;
    while($row=$query->fetch_assoc()){

        $sect=$row['Section'];//10
        $sql2 = "SELECT `Section` FROM `alldata` WHERE Section='".$sect."';";
//        echo "<br>$sql2<br>";
        if($query2=$db->con->query($sql2)){
            $num_row=$query2->num_rows;
            $num_section = $sect;
            $result[$j]['alldata']=$num_row;
            $result[$j]['num_section']=$num_section;
        }else{
            echo 'Error: No Data';
        }
        $sql2 = "SELECT `Section` FROM `db` WHERE Section='".$row['Section']."0';";
        if($query2=$db->con->query($sql2)){
            $num_row=$query2->num_rows;
            $num_section = $sect;
            $result[$j]['db']=$num_row;
            $result[$j]['num_section']=$num_section;
        }else{
            echo 'Error: No Data';
        }
        $j++;
    }
    $j=0;
}else{
    echo "error: db";
}
$sql3="SELECT ID FROM `alldata`;";
if($query3=$db->con->query($sql3)){
    $result['alldata']=$query3->num_rows;
}else{
    echo "error: db";
}
$sql3="SELECT ID FROM `db`;";
if($query3=$db->con->query($sql3)){
    $result['db']=$query3->num_rows;
}else{
    echo "error: db";
}
//print_r($result);

?>
<div class="flex-container" style="align-content: start;">
    <?php
    for($i=0;$i<=count($result);$i++){
        if($i==0){
            echo "<table class='flex-item'>
                    <thead>
                        <tr>
                            <th>".$dataLoad['staticTableSection']."</th>
                            <th>".$dataLoad['staticTableCity']."</th>
                            <th>".$dataLoad['staticTableRusSpeech']."</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>".$result[$i]['num_section']."</td>
                        <td>".$result[$i]['db']."</td>
                        <td>".$result[$i]['alldata']."</td></tr>";
        }else if(($i==11)||($i==22)||($i==33)||($i==44)||($i==55)){
           echo "    </tbody>
                    </table>
                <table class='flex-item'>
                    <thead>
                        <tr>
                            <th>".$dataLoad['staticTableSection']."</th>
                            <th>".$dataLoad['staticTableCity']."</th>
                            <th>".$dataLoad['staticTableRusSpeech']."</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>".$result[$i]['num_section']."</td>
                        <td>".$result[$i]['db']."</td>
                        <td>".$result[$i]['alldata']."</td></tr>";
        }else if($i==count($result)){
                echo "<tr>
                        <td>".$result[$i]['num_section']."</td>
                        <td>".$result[$i]['db']."</td>
                        <td>".$result[$i]['alldata']."</td></tr>
                        <tr><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td></tr>
                       <tr><td><b>".$dataLoad['staticTableTotal']."</b></td><td><b>".$result['db']."</b></td><td><b>".$result['alldata']."</b></td></tr>
                        </tbody>
                     </table>";

        }else{
            echo "<tr><td>".$result[$i]['num_section']."</td>
                  <td>".$result[$i]['db']."</td>
                  <td>".$result[$i]['alldata']."</td></tr>";
        }

    }


    ?>
</div>