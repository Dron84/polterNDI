<?php
define('root',$_SERVER['DOCUMENT_ROOT']);
require_once root.'/function/db.php';
require_once root.'/function/function.php';
$db = new db();
if (isset($_COOKIE['lang'])){
    if($_COOKIE['lang']=='ru'){
        $dataLoad = loadRu('ru');
    }else{
        $dataLoad = loadRu('he');
    }
}else if(empty($_COOKIE['lang'])){
    $dataLoad = loadRu('ru');
}
$result=array();
$elections=0;
//print_r($dataLoad);
$sql = "SELECT Phone,Surname,Name,ID FROM `alldata` WHERE Control='s';";
$db->con->set_charset('utf8mb4');
if($query =$db->con->query($sql)){
    $sql5="select * FROM `alldata` WHERE Control IS NULL";
    if($query5=$db->con->query($sql5)) {
        $AllNull=$query5->num_rows;
    }
    $sql5="select * FROM `alldata` WHERE Control IS NULL AND Elections=1";
    if($query5=$db->con->query($sql5)) {
        $ElectNull=$query5->num_rows;
    }
    if ($AllNull!=0){
        $proc=(($ElectNull/$AllNull)*100);
        $proc = intval($proc);
    }
    echo '<div class="flex-item indicators green">
            NULL Control <br>data on user<br>
            <div class="input-group">
                <input type="text" value="'.$AllNull.'" data-count="'.$AllNull.'" class="form-control" disabled style="width: 5em;">
                <input type="text" value="'.$ElectNull.'" data-value="'.$ElectNull.'" class="form-control" disabled style="width: 5em; margin-left: 25px">
            </div>
            <span class="proc">'.$proc.'%</span>
        </div>';
    while($row = $query->fetch_assoc()){
//        print_r($row);echo"<br>";
        if($row['ID']=='341284636'){
            $sql3="SELECT * FROM `sslist`;";
            if($query3=$db->con->query($sql3)){
                while($row3=$query3->fetch_assoc()){
                    $sql6 = "SELECT Elections,Phone,Name,ID,Strit,Home,Apartments,Section,NumberInSection,Control FROM `alldata` WHERE ID='".$row3['ID']."';";
                    if($query6=$db->con->query($sql6)){
                        if($query6->num_rows>=1){
                            $row6=$query6->fetch_assoc();
//                            print_r($row6);
                            for($jk=0;$jk<count($result);$jk++){
                                if($result[$jk]['ID']!=$row6['ID']){

                                }
                            }
                            $result[]=$row6;

                            if($row6['Elections']=='1'){
                                $elections++;
                            }


                        }

                    }
                }
            }
            $sql7="SELECT Elections,Phone,Name,ID,Strit,Home,Apartments,Section,NumberInSection,Control FROM `alldata` WHERE Control='s';";
            if($query7=$db->con->query($sql7)){
                while($row7=$query7->fetch_assoc()){
                    if($row7['ID']!='341284636'){
                        $sql9 = "SELECT * FROM `sslist` WHERE ID='".$row7['ID']."';";
                        if($query9=$db->con->query($sql9)){
                            while ($row9=$query9->fetch_assoc()){
                                $result[]=$row9;
                                if($row9['Elections']=='1'){
                                    $elections++;
                                }
                            }
                        }
                    }
                }
            }

        }
        $Phone = explode(' ',trim($row['Phone']));
        $sql2="SELECT Elections,Phone,Name,ID,Strit,Home,Apartments,Section,NumberInSection,Control FROM `alldata` WHERE Control='".$row['ID']."';";
        if($query2 =$db->con->query($sql2)){
            while ($row2=$query2->fetch_assoc()){
//                print_r($row2);echo"<br>";

                $result[]= $row2;
                if($row2['Elections']==1){
                    $elections++;
                }
            }
        }else{
            echo 'error';
        }

        $resultCount = count($result);
//       print_r($result);
        if ($resultCount!=0){
            $proc=(($elections/$resultCount)*100);
            $proc = intval($proc);
        }
        $localtime_assoc = localtime(time(), true);
        $hour = $localtime_assoc['tm_hour'];
        $hour = $hour+8;
        if($hour>=24){
            $hour=$hour-24;
        }
        if($hour<=12){
            if($proc<=5){
                $color = 'red';
            }else if(($proc>5)&&($proc<15)){
                $color = 'yellow';
            }else if($proc>15){
                $color = 'green';
            }
        }else if(($hour>12)||($hour<15)){
            if($proc<=15){
                $color = 'red';
            }else if(($proc>15)&&($proc<35)){
                $color = 'yellow';
            }else if($proc>=35){
                $color = 'green';
            }
        }else if($hour>=15){
            if($proc<=40){
                $color = 'red';
            }else if(($proc>40)&&($proc<50)){
                $color = 'yellow';
            }else if($proc>=50){
                $color = 'green';
            }
        }
//        print_r($result);
        if($resultCount!=0){
            echo '<div class="flex-item indicators '.$color.'" data-toggle="modal" data-target="#'.$row['ID'].'">
                '.$row['Name'].' '.$row['Surname'].'<br>'.$Phone[0].'<br>
                <div class="input-group">
                    <input type="text" value="'.$resultCount.'" data-count="'.$resultCount.'" class="form-control" disabled style="width: 5em;">
                    <input type="text" value="'.$elections.'" data-value="'.$elections.'" class="form-control" disabled style="width: 5em; margin-left: 25px">
                </div>
                <span class="proc">'.$proc.'%</span>
            </div>
            <!-- Modal -->
            <div id="'.$row['ID'].'" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 60vw">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">'.$dataLoad['allDataTabelName'].': '.$row['Name'].' '.$row['Surname'].' '.$dataLoad['allDataTabelphone'].': '.$row['Phone'].'</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr><th>#</th><th>'.$dataLoad['allDataTabelElections'].'</th><th>'.$dataLoad['allDataTabelphone'].'</th><th>'.$dataLoad['allDataTabelName'].'</th><th>'.$dataLoad['allDataTabelID'].'</th><th>'.$dataLoad['respodAddress'].'</th><th>'.$dataLoad['allDataTabelSection'].'</th><th>'.$dataLoad['allDataTabelN_in_section'].'</th></tr>
                                    </thead><tbody>';
//                                    print_r($result);
            for ($i=0;$i<count($result);$i++) {
                if ($result[$i]['Elections'] != 1) {
                $r=$i+1;
                echo "<tr>
                        <td>".$r."</td>
                        <td>" . $result[$i]['Elections'] . "</td>
                        <td>" . $result[$i]['Phone'] . "</td>
                        <td>" . $result[$i]['Name'] . "</td>
                        <td>" . $result[$i]['ID'] . "</td>
                        <td>" . $result[$i]['Apartments'] . " " . $result[$i]['Home'] . " " . $result[$i]['Strit'] . "</td>
                        <td>" . $result[$i]['Section'] . "</td>
                        <td>" . $result[$i]['NumberInSection'] . "</td>
                      </tr>";
                }
            }
            echo'</tbody></table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$dataLoad['Close'].'</button>
                        </div>
                    </div>

                </div>
            </div>';
        }

        unset($result);
        $elections=0;
    }
}else{
    echo 'error';
}
//$sql4="SELECT Phone,Surname,Name,ID FROM `alldata` WHERE ID='341284636';";
//$db->con->set_charset('utf8mb4');
//if($query4=$db->con->query($sql4)){
//    $row = $query4->fetch_assoc();
//    $Phone=explode(' ', $row['Phone']);
//    $result6=array();
//    $sql3="SELECT * FROM `sslist`;";
//    if($query3=$db->con->query($sql3)){
//        while($row3=$query3->fetch_assoc()){
//            $sql6 = "SELECT Elections,Phone,Name,ID,Strit,Home,Apartments,Section,NumberInSection,Control FROM `alldata` WHERE ID='".$row3['ID']."';";
//            if($query6=$db->con->query($sql6)){
//                if($query6->num_rows>=1){
//                    $row6=$query6->fetch_assoc();
//                    $result6[]=array('Elections'=>$row6['Elections'],'Phone'=>$row6['Phone'],'Name'=>$row6['Name'],'ID'=>$row6['ID'],'Strit'=>$row6['Strit'],'Home'=>$row6['Home'],'Apartments'=>$row6['Apartments'],'Section'=>$row6['Section'],'NumberInSection'=>$row6['NumberInSection']);
//                }
//
//            }
//        }
//    }
//    $sql7="SELECT Elections,Phone,Name,ID,Strit,Home,Apartments,Section,NumberInSection,Control FROM `alldata` WHERE Control='s';";
//    if($query7=$db->con->query($sql7)){
//        while($row7=$query7->fetch_assoc()){
//            if($row7['ID']!='341284636'){
//                $sql9 = "SELECT * FROM `sslist` WHERE ID='".$row7['ID']."';";
//                if($query9=$db->con->query($sql9)){
//                    if($queru9->num_rows==0){
//                        $result6[]=array('Elections'=>$row7['Elections'],'Phone'=>$row7['Phone'],'Name'=>$row7['Name'],'ID'=>$row7['ID'],'Strit'=>$row7['Strit'],'Home'=>$row7['Home'],'Apartments'=>$row7['Apartments'],'Section'=>$row7['Section'],'NumberInSection'=>$row7['NumberInSection']);
//                    }
//                }
//            }
//        }
//    }
////    print_r($result6); echo'<br>';
//    $elections = 0;
//    for($i=0;$i<count($result6);$i++){
//        $sql8 = "SELECT Elections,ID FROM `alldata` WHERE ID='".$result6[$i]['ID']."' AND Elections='1';";
//        if($query8=$db->con->query($sql8)){
//            if($query8->num_rows>0){
//                $elections++;
//            }
//        }
//    }
//    $resultCount = count($result6);
//    if ($resultCount!=0){
//        $proc=(($elections/$resultCount)*100);
//        $proc = intval($proc);
//    }
//    $localtime_assoc = localtime(time(), true);
//    $hour = $localtime_assoc['tm_hour'];
//    $hour = $hour+8;
//    if($hour>=24){
//        $hour=$hour-24;
//    }
//    if($hour<=12){
//        if($proc<=5){
//            $color = 'red';
//        }else if(($proc>5)&&($proc<15)){
//            $color = 'yellow';
//        }else if($proc>15){
//            $color = 'green';
//        }
//    }else if(($hour>12)||($hour<15)){
//        if($proc<=15){
//            $color = 'red';
//        }else if(($proc>15)&&($proc<35)){
//            $color = 'yellow';
//        }else if($proc>=35){
//            $color = 'green';
//        }
//    }else if($hour>=15){
//        if($proc<=40){
//            $color = 'red';
//        }else if(($proc>40)&&($proc<50)){
//            $color = 'yellow';
//        }else if($proc>=50){
//            $color = 'green';
//        }
//    }
//    echo '<div class="flex-item indicators '.$color.'" data-toggle="modal" data-target="#'.$row['ID'].'">
//            SS user '.$row['Name'].' '.$row['Surname'].'<br>'.$Phone[0].'<br>
//            <div class="input-group">
//                <input type="text" value="'.$resultCount.'" data-count="'.$resultCount.'" class="form-control" disabled style="width: 5em;">
//                <input type="text" value="'.$elections.'" data-value="'.$elections.'" class="form-control" disabled style="width: 5em; margin-left: 25px">
//            </div>
//            <span class="proc">'.$proc.'%</span>
//        </div>';
//    echo '<!-- Modal -->
//            <div id="'.$row['ID'].'" class="modal fade" role="dialog">
//                <div class="modal-dialog" style="width: 60vw">
//
//                    <!-- Modal content-->
//                    <div class="modal-content">
//                        <div class="modal-header">
//                            <button type="button" class="close" data-dismiss="modal">&times;</button>
//                            <h4 class="modal-title">'.$dataLoad['allDataTabelName'].': '.$row['Name'].' '.$row['Surname'].' '.$dataLoad['allDataTabelphone'].': '.$row['Phone'].'</h4>
//                        </div>
//                        <div class="modal-body">
//                            <div class="table-responsive">
//                                <table class="table">
//                                    <thead>
//                                        <tr><th>'.$dataLoad['allDataTabelElections'].'</th><th>'.$dataLoad['allDataTabelphone'].'</th><th>'.$dataLoad['allDataTabelName'].'</th><th>'.$dataLoad['allDataTabelID'].'</th><th>'.$dataLoad['respodAddress'].'</th><th>'.$dataLoad['allDataTabelSection'].'</th><th>'.$dataLoad['allDataTabelN_in_section'].'</th></tr>
//                                    </thead><tbody>';
////                                    print_r($result);
//                                    for ($kk=0;$kk<count($result6);$kk++) {
//                                        if ($result6[$kk]['Elections'] != 1) {
//                                            echo "<tr><td>" . $result6[$kk]['Elections'] . "</td>
//                                                <td>" . $result6[$kk]['Phone'] . "</td>
//                                                <td>" . $result6[$kk]['Name'] . "</td>
//                                                <td>" . $result6[$kk]['ID'] . "</td>
//                                                <td>" . $result6[$kk]['Apartments'] . " " . $result6[$kk]['Home'] . " " . $result6[$kk]['Strit'] . "</td>
//                                                <td>" . $result6[$kk]['Section'] . "</td>
//                                                <td>" . $result6[$kk]['NumberInSection'] . "</td>
//                                              </tr>";
//                                        }
//                                    }
//                            echo'</tbody></table>
//                            </div>
//                        </div>
//                        <div class="modal-footer">
//                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$dataLoad['Close'].'</button>
//                        </div>
//                    </div>
//
//                </div>
//            </div>';
//
//}
