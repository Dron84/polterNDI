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
        }else{
            echo 'Error: No Data';
        }
        $sql2 = "SELECT `Section` FROM `alldata` WHERE Section='".$sect."' AND Elections='1';";
//        echo "<br>$sql2<br>";
        if($query2=$db->con->query($sql2)){
            $num_row=$query2->num_rows;
            $num_section = $sect;
            $result[$j]['allElections']=$num_row;
        }else{
            $result[$j]['allElections']=0;
        }
        $sql2 = "SELECT `Section` FROM `db` WHERE Section='".$row['Section']."0';";
        if($query2=$db->con->query($sql2)){
            $num_row=$query2->num_rows;
            $num_section = $sect;
            $result[$j]['db']=$num_row;
        }else{
            echo 'Error: No Data';
        }
        $sql2 = "SELECT `Section` FROM `db` WHERE Section='".$row['Section']."0' AND Elections='1';";
        if($query2=$db->con->query($sql2)){
            $num_row=$query2->num_rows;
            $num_section = $sect;
            $result[$j]['dbElections']=$num_row;
        }else{
            $result[$j]['dbElections']=0;

        }
        $result[$j]['num_section']=$num_section;
        $j++;
    }
    $j=0;
}else{
    echo "error: db";
}
//$sql3="SELECT ID FROM `alldata`;";
//if($query3=$db->con->query($sql3)){
//    $result[]['alldata']=$query3->num_rows;
//}else{
//    echo "error: db";
//}
//$sql3="SELECT ID FROM `alldata` WHERE Elections='1';";
//if($query3=$db->con->query($sql3)){
//    $result[]['allElections']=$query3->num_rows;
//}else{
//    echo "error: db";
//}
//$sql3="SELECT ID FROM `db`;";
//if($query3=$db->con->query($sql3)){
//    $result[]['db']=$query3->num_rows;
//}else{
//    echo "error: db";
//}
//$sql3="SELECT ID FROM `db` WHERE Elections='1';";
//if($query3=$db->con->query($sql3)){
//    $result[]['dbElections']=$query3->num_rows;
//}else{
//    echo "error: db";
//}
//$result[]['num_section']='1000';
?>
<div class="flex-container" style="align-content: start;">

    <?php
    for ($i=0; $i<count($result); $i++){
        $id = $result[$i]['num_section'];
        $alldata = $result[$i]['alldata'];
        $allElections = $result[$i]['allElections'];
        $db = $result[$i]['db'];
        $dbElections = $result[$i]['dbElections'];
        echo "<div class='flex-item'>";
             echo"<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#".$result[$i]['num_section']."'' data-section='".$result[$i]['num_section']."' data-sectionTitle='".$dataLoad['allDataTabelSection']."' data-alldata='".$result[$i]['alldata']."' data-allElections='".$result[$i]['allElections']."' data-db='".$result[$i]['db']."' data-dbElections='".$result[$i]['dbElections']."'>".$dataLoad['allDataTabelSection'].": ".$result[$i]['num_section']."</button>
                    
                    <!-- Modal -->
                    <div id='".$result[$i]['num_section']."' class='modal fade' role='dialog'>
                      <div class='modal-dialog'>
                    
                        <!-- Modal content-->
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'>".$dataLoad['allDataTabelSection'].": ".$result[$i]['num_section']."</h4>
                          </div>
                          <div class='modal-body'>
                            <div id='result_".$result[$i]['num_section']."'>";
                            include 'chartshow.php';
                        echo"</div>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>".$dataLoad['Close']."</button>
                          </div>
                        </div>
                    
                      </div>
                    </div>";
        echo "</div>";
    }
    ?>
</div>