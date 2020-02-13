<?php

if(!defined('root')){
    define('root',$_SERVER['DOCUMENT_ROOT']);
}
require_once(root.'/function/db.php');
require_once(root.'/function/function.php');
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
if(isset($_COOKIE['group'])){
    if($_COOKIE['group']!='3'){

        $result=array();
        $elections=0;
//print_r($dataLoad);
        $sql = "SELECT Phone,Name,ID,Strit,Home,Apartments FROM `alldata` WHERE Control='s';";
        $db->con->set_charset('utf8mb4');
//        shell_exec('rm -f indic.json');
        if($query =$db->con->query($sql)){
            while($row = $query->fetch_assoc()){
//        print_r($row);echo"<br>";

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
                $removedId=array();
                $sql3 = "SELECT removedId FROM `FakeRemove` WHERE person='" . $row['ID'] . "'";
                if ($query3 = $db->con->query($sql3)) {
                    $electionsNew = $query3->num_rows;
//                    $removedId = $query3->fetch_assoc();
                    while($row3=$query3->fetch_assoc()){
                        $removedId[]=$row3['removedId'];
                    }
//                    print_r($removedId);
                }
                if($elections<$electionsNew){
                    $elections=$electionsNew;
                }
                $resultCount = count($result);
//                echo '$resultCount='.$resultCount;
//                print_r($result);
                if($resultCount!=0){
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

                echo '<div class="flex-item indicators '.$color.'" data-toggle="modal" data-target="#'.$row['ID'].'">
                '.$row['Name'].'<br>'.$Phone[0].'<br>'.$row['Apartments'].$row['Home'].$row['Strit'].'<br>
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
                            <h4 class="modal-title">'.$dataLoad['allDataTabelName'].': '.$row['Name'].' '.$dataLoad['allDataTabelphone'].': '.$row['Phone'].' '.$dataLoad['respodAddress'].': '.$row['Home'].' '.$row['Strit'].'</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr><th>'.$dataLoad['allDataTabelElections'].'</th><th>'.$dataLoad['allDataTabelphone'].'</th><th>'.$dataLoad['allDataTabelName'].'</th><th>'.$dataLoad['allDataTabelID'].'</th><th>'.$dataLoad['respodAddress'].'</th><th>'.$dataLoad['allDataTabelSection'].'</th><th>'.$dataLoad['allDataTabelN_in_section'].'</th><th>Remove</th></tr>
                                    </thead><tbody>';
//                                    print_r($result);
                                    for ($i=0;$i<count($result);$i++) {
                                        if ($result[$i]['Elections'] != 1) {

                                            if(count($removedId)>0){
                                                for($k=0; $k<count($removedId);$k++){
                                                    if($result[$i]['ID']==$removedId[$k]){
                                                        $show = false;
                                                        break;
                                                    }else{
                                                        $show = true;

                                                    }
                                                }
                                            }else{
                                                $show=true;
                                            }

                                                if ($show==true){
                                                    echo "<tr id='".$result[$i]['ID']."'><td>" . $result[$i]['Elections'] . "</td>
                                                            <td>" . $result[$i]['Phone'] . "</td>
                                                            <td>" . $result[$i]['Name'] . "</td>
                                                            <td>" . $result[$i]['ID'] . "</td>
                                                            <td>" . $result[$i]['Apartments'] . " " . $result[$i]['Home'] . " " . $result[$i]['Strit'] . "</td>
                                                            <td>" . $result[$i]['Section'] . "</td>
                                                            <td>" . $result[$i]['NumberInSection'] . "</td>
                                                            <td><button data-id='".$result[$i]['ID']."' data-person='".$row['ID']."' class='remove'><i class='glyphicon glyphicon-remove'></i></button></td>
                                                          </tr>";
                                                }
                                                $show = false;
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
                unset($result);
                unset($removedId);
                $elections=0;

            }
        }else{
            echo 'error';
        }
    }else if($_COOKIE['group']=='3') {
        $result=array();
        $elections=0;
//print_r($dataLoad);
        $sql = "SELECT Phone,Name,ID,Strit,Home,Apartments FROM `alldata` WHERE Control='s';";
        $db->con->set_charset('utf8mb4');
//        shell_exec('rm -f indic.json');
        if($query =$db->con->query($sql)){
            while($row = $query->fetch_assoc()){
//        print_r($row);echo"<br>";

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
                $removedId=array();
                $sql3 = "SELECT removedId FROM `FakeRemove` WHERE person='" . $row['ID'] . "'";
                if ($query3 = $db->con->query($sql3)) {
                    $electionsNew = $query3->num_rows;
//                    $removedId = $query3->fetch_assoc();
                    while($row3=$query3->fetch_assoc()){
                        $removedId[]=$row3['removedId'];
                    }
//                    print_r($removedId);
                }
                if($elections<$electionsNew){
                    $elections=$electionsNew;
                }
                $resultCount = count($result);
//                echo '$resultCount='.$resultCount;
//                print_r($result);
                if($resultCount!=0){
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

                echo '<div class="flex-item indicators '.$color.'" data-toggle="modal" data-target="#'.$row['ID'].'">
                '.$row['Name'].'<br>'.$Phone[0].'<br>'.$row['Apartments'].$row['Home'].$row['Strit'].'<br>
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
                            <h4 class="modal-title">'.$dataLoad['allDataTabelName'].': '.$row['Name'].' '.$dataLoad['allDataTabelphone'].': '.$row['Phone'].' '.$dataLoad['respodAddress'].': '.$row['Home'].' '.$row['Strit'].'</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr><th>'.$dataLoad['allDataTabelElections'].'</th><th>'.$dataLoad['allDataTabelphone'].'</th><th>'.$dataLoad['allDataTabelName'].'</th><th>'.$dataLoad['allDataTabelID'].'</th><th>'.$dataLoad['respodAddress'].'</th><th>'.$dataLoad['allDataTabelSection'].'</th><th>'.$dataLoad['allDataTabelN_in_section'].'</th></tr>
                                    </thead><tbody>';
//                                    print_r($result);
                for ($i=0;$i<count($result);$i++) {
                    if ($result[$i]['Elections'] != 1) {

                        if(count($removedId)>0){
                            for($k=0; $k<count($removedId);$k++){
                                if($result[$i]['ID']==$removedId[$k]){
                                    $show = false;
                                    break;
                                }else{
                                    $show = true;

                                }
                            }
                        }else{
                            $show=true;
                        }

                        if ($show==true){
                            echo "<tr id='".$result[$i]['ID']."'><td>" . $result[$i]['Elections'] . "</td>
                                                            <td>" . $result[$i]['Phone'] . "</td>
                                                            <td>" . $result[$i]['Name'] . "</td>
                                                            <td>" . $result[$i]['ID'] . "</td>
                                                            <td>" . $result[$i]['Apartments'] . " " . $result[$i]['Home'] . " " . $result[$i]['Strit'] . "</td>
                                                            <td>" . $result[$i]['Section'] . "</td>
                                                            <td>" . $result[$i]['NumberInSection'] . "</td>
                                                            
                                                          </tr>";
                        }
                        $show = false;
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
                unset($result);
                unset($removedId);
                $elections=0;

            }
        }else{
            echo 'error';
        }
    }

}

