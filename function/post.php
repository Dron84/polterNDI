<?php
/**
 * Created by PhpStorm.
 * User: Dron84
 * Date: 05.10.2018
 * Time: 10:01
 * AutorSite: uniquesite.ru
 */
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

if (isset($_POST['loginIn'])){
    if($_POST['loginIn']=='login'){
        $login = strtolower($_POST['login']);
        $pass = $_POST['password'];
        $sql = "SELECT nickname,pass,premission_group FROM `users` WHERE nickname='".$login."' AND pass='".$pass."';";
//        echo $sql;
        if ($query = $db->con->query($sql)){
            if($query->num_rows===1){
                $row = $query->fetch_assoc();
//                print_r($row);
                setcookie('nickname', $row['nickname'],time()+2678400,'/');
                setcookie('group', $row['premission_group'],time()+2678400,'/');
//                setcookie('lastname', $row['lastname'],time()+2678400,'/');
//                setcookie('email', $row['email'],time()+2678400,'/');
                header("Location: /");
            }else if($query->num_rows===0){
                header("Location: ".$_SERVER['HTTP_REFERER']."?error=1");
            }
        }
    }
}else if(isset($_POST['userstable'])){
    if($_POST['userstable']=='load'){
        $sql = "SELECT * FROM `users`;";
        if($query = $db->con->query($sql)){
            echo "<thead><tr><th>".$dataLoad['respodID']."</th><th>".$dataLoad['respodName']."</th><th>".$dataLoad['SettingsDate']."</th></tr></thead><tbody>";
            while ($row = $query->fetch_assoc()){
                echo "<tr><td>".$row['id']."</td><td>".$row['nickname']."</td><td>".$row['reg_date']."</td></td>";
//                print_r($row);
            }
            echo "</tbody>";
        }
    }

}else if(isset($_POST['useradd'])){
    if($_POST['useradd']=='add'){
        $login = strtolower($_POST['login']);
        if(empty($login)){
            header('HTTP/1.0 304 Not Modified', true, 304);
        }else{
            $pass = $_POST['password'];
            $sql = "SELECT * FROM `users` WHERE nickname='".$login."';";
            if($query = $db->con->query($sql)){
                if($query->num_rows==0){
                    $sql = "INSERT INTO `users` (nickname,pass,admin,premission_group) VALUE ('".$login."','".$pass."','1','2')";
                    if ($query = $db->con->query($sql)){
                        header('HTTP/1.0 200 OK', true,200);
                    }else{
                        header('HTTP/1.0 304 Not Modified', true, 304);
                    }
                }else if($query->num_rows>0){
                    header('HTTP/1.0 403 Forbirden',true,403);
                }
            }
        }

    }

}else if (isset($_POST['userdel'])) {
    $userdel = $_POST['userdel'];
    $sql = "DELETE FROM `users` WHERE id='" . $userdel . "';";
    if ($query = $db->con->query($sql)) {
        header('HTTP/1.0 200 OK', true,200);
    } else {
        header('HTTP/1.0 304 Not Modified', true, 304);
    }
}else if((isset($_POST['dbload']))&&(isset($_POST['table']))){
    if($_POST['dbload']=='load'){
        $table = $_POST['table'];
        if ($table=='db'){
            if(isset($_POST['limits'])){
                $limits = $_POST['limits'];
                $sql = "SELECT * FROM `".$table."` LIMIT $limits,200 ;";
                $i = $limits+1;
            }else{
                $sql = "SELECT * FROM `".$table."` LIMIT 0,200 ;";
                $i = 1;
            }
            $db->con->set_charset('utf8mb4');
            if ($query = $db->con->query($sql)) {
                while($row = $query->fetch_assoc()){
                    echo "<tr data-limit='".$i."'>
                            <td>".$i."</td>
                            <td>".$row['Elections']."</td>
                            <td>".$row['Building']."</td>
                            <td>".$row['Apartment']."</td>
                            <td>".$row['Home']."</td>
                            <td>".$row['Strit']."</td>
                            <td>".$row['NumberInSection']."</td>
                            <td>".($row['Section']/10)."</td>
                            <td>".$row['Surname']."</td>
                            <td>".$row['Name']."</td>
                            <td>".$row['ID']."</td>
                        </tr>";
                    $i++;
                }

            } else {
                header('HTTP/1.0 304 Not Modified', true, 304);
            }
        }else if ($table=='alldata'){
            if(isset($_POST['limits'])){
                $limits = $_POST['limits'];
                $sql = "SELECT * FROM `".$table."` LIMIT $limits,200 ;";
                $j = $limits+1;
            }else{
                $sql = "SELECT * FROM `".$table."` LIMIT 0,200 ;";
                $j = 1;
            }
//            echo $sql;
            $db->con->set_charset('utf8mb4');
            if ($query = $db->con->query($sql)) {
//                print_r($query);
                while($row = $query->fetch_assoc()){
                    echo "<tr data-limit='".$j."'>
                            <td>".$j."</td>
                            <td>".$row['Elections']."</td>
                            <td>".$row['Comment_2']."</td>
                            <td>".$row['Comment_1']."</td>
                            <td>".$row['Ring_3']."</td>
                            <td>".$row['Ring_2']."</td>
                            <td>".$row['Ring_1']."</td>
                            <td>".$row['dontSay']."</td>
                            <td>".$row['noAnswer']."</td>
                            <td>".$row['notGo']."</td>
                            <td>".$row['notSelect']."</td>
                            <td>".$row['NO']."</td>
                            <td>".$row['building']."</td>
                            <td>".$row['Apartments']."</td>
                            <td>".$row['Home']."</td>
                            <td>".$row['Strit']."</td>
                            <td>".$row['NumberInSection']."</td>
                            <td>".$row['Section']."</td>
                            <td>".$row['phone']."</td>
                            <td>".$row['Surname']."</td>
                            <td>".$row['Name']."</td>
                            <td>".$row['ID']."</td>
                            <td>".$row['Responsible']."</td>
                            <td>".$row['newTel']."</td>
                            <td>".$row['N']."</td>
                            <td>".$row['Control']."</td>
                </tr>";
                    $j++;
                }

            } else {
                header('HTTP/1.0 304 Not Modified', true, 304);
            }
        }
    }
    if($_POST['dbload']=='sort'){
        $table=$_POST['table'];
        $val = $_POST['val'];
        $sql = "SELECT * FROM `".$table."` WHERE ID LIKE '%$val%' ;";
//        echo $sql;
        $db->con->set_charset('utf8mb4');
        if($table=='db') {
            if ($query = $db->con->query($sql)) {
                while ($row = $query->fetch_assoc()) {
                    echo "<tr data-limit='" . $i . "'>
                            <td>" . $i . "</td>
                            <td>" . $row['Elections'] . "</td>
                            <td>" . $row['Building'] . "</td>
                            <td>" . $row['Apartment'] . "</td>
                            <td>" . $row['Home'] . "</td>
                            <td>" . $row['Strit'] . "</td>
                            <td>" . $row['NumberInSection'] . "</td>
                            <td>" . ($row['Section'] / 10) . "</td>
                            <td>" . $row['Surname'] . "</td>
                            <td>" . $row['Name'] . "</td>
                            <td>" . $row['ID'] . "</td>
                        </tr>";
                    $i++;
                }

            }
        }else if($table=='alldata') {
            if ($query = $db->con->query($sql)) {
//                print_r($query);
                while ($row = $query->fetch_assoc()) {
                    echo "<tr data-limit='" . $j . "'>
                            <td>" . $j . "</td>
                            <td>" . $row['Elections'] . "</td>
                            <td>" . $row['Comment_2'] . "</td>
                            <td>" . $row['Comment_1'] . "</td>
                            <td>" . $row['Ring_3'] . "</td>
                            <td>" . $row['Ring_2'] . "</td>
                            <td>" . $row['Ring_1'] . "</td>
                            <td>" . $row['dontSay'] . "</td>
                            <td>" . $row['noAnswer'] . "</td>
                            <td>" . $row['notGo'] . "</td>
                            <td>" . $row['notSelect'] . "</td>
                            <td>" . $row['NO'] . "</td>
                            <td>" . $row['building'] . "</td>
                            <td>" . $row['Apartments'] . "</td>
                            <td>" . $row['Home'] . "</td>
                            <td>" . $row['Strit'] . "</td>
                            <td>" . $row['NumberInSection'] . "</td>
                            <td>" . $row['Section'] . "</td>
                            <td>" . $row['phone'] . "</td>
                            <td>" . $row['Surname'] . "</td>
                            <td>" . $row['Name'] . "</td>
                            <td>" . $row['ID'] . "</td>
                            <td>" . $row['Responsible'] . "</td>
                            <td>" . $row['newTel'] . "</td>
                            <td>" . $row['N'] . "</td>
                            <td>" . $row['Control'] . "</td>
                </tr>";
                    $j++;
                }

            }
        }
    }

}else if(isset($_POST['check'])){
    if($_POST['check']=='checkpeople'){
        $val = $_POST['val'];
        $sql = "SELECT `Name`,`Strit`,`Home`,`Apartments`,`Phone`,`ID` FROM `alldata` WHERE ID=".$val.";";
        $db->con->set_charset('utf8mb4');
        if($query=$db->con->query($sql)){
            if($query->num_rows>0){
                $row = $query->fetch_assoc();
                echo "<td>".$row['ID']."</td><td>".$row['Name']."</td><td>".$row['Apartments']." ".$row['Home']." ".$row['Strit']."</td><td>".$row['Phone']."</td>";
            }else{
                header('HTTP/1.0 304 Not Modified', true, 304);
            }
        }else{
            header('HTTP/1.0 304 Not Modified', true, 304);
        }
    }
}else if(isset($_POST['submit'])){
    if($_POST['submit']=='all_save'){
        $res_id = $_POST['res_id'];
        $res_name = $_POST['res_name'];
        $res_address = $_POST['res_address'];
        $res_tel = $_POST['res_tel'];
        $pep_id = $_POST['pep_id'];
        $sql = "INSERT INTO `responsable` (resId,resName,resAddress,resTel,pepId) VALUES ($res_id,'$res_name','$res_address','$res_tel','$pep_id')";
//        echo $sql;
//        $query=$db->con->query($sql);
        if($query=$db->con->query($sql)){
//            echo 'ok';
            header('location: /');
        }else{
            echo 'notmodifid';
//            header('HTTP/1.0 304 Not Modified', true, 304);
        }
    }

}else if(isset($_POST['resLoad'])){
    if($_POST['resLoad']=='load'){
        $sql = "SELECT `id`,`resId`,`resName`,`resAddress`,`resTel` FROM `responsable`;";
        if($query=$db->con->query($sql)){
            while($row = $query->fetch_assoc()){
                echo "<tr><td>".$row['id']."</td><td>".$row['resId']."</td><td>".$row['resName']."</td><td>".$row['resAddress']."</td><td>".$row['resTel']."</td></tr>";
            }
        }else{
            header('HTTP/1.0 304 Not Modified', true, 304);
        }
    }

}else if(isset($_POST['election'])){
    if($_POST['election']=='add'){
        if(!empty($_POST['elections'])){
            $section = $_POST['section'];
            $elections = $_POST['elections'];
            $elections = explode(' ',$elections);
            foreach ($elections as $value){
                $sql = "SELECT Section,NumberInSection,ID FROM `alldata` WHERE Section = '$section' AND NumberInSection='$value';";
//                echo $sql;
                if($query=$db->con->query($sql)){
                    if($query->num_rows>0){
//                        print_r($query);
                        while($row=$query->fetch_array()){
//                            print_r($row);
                            $sql2 = "UPDATE `alldata` SET Elections='1' WHERE ID=".$row['ID'].";";
                           if($query2 = $db->con->query($sql2)){
                               echo '<li>ID='.$row['ID'].' Section = '.$section.' and value = '.$value.' CHANGE on All Data tabel</li>';
                           }else{
                               echo '<li>ID= NOT CHENGE on All Data tabel</li>';
                           }

                        }
                    }else{
                        echo '<li>Section = '.$section.' and value = '.$value.' NOT CHANGE: because not found on All Data tabel</li>';
                    }

                }else{
                    echo 'error change value='.$value;
                }
            }
            foreach ($elections as $value){
                $sql = "SELECT Section,NumberInSection,ID FROM `db` WHERE Section = '".$section."0"."' AND NumberInSection='$value';";
//                echo $sql;
                if($query=$db->con->query($sql)){
                    if($query->num_rows>0){
//                        print_r($query);
                        while($row=$query->fetch_array()){
//                            print_r($row);
                            $sql2 = "UPDATE `db` SET Election='1' WHERE ID=".$row['ID'].";";
                            if($query2 = $db->con->query($sql2)){
                                echo '<li>ID='.$row['ID'].' Section = '.$section.' and value = '.$value.' CHANGE on DB tabel</li>';
                            }else{
                                echo '<li>ID= NOT CHENGE on DB tabel</li>';
                            }

                        }
                    }else{
                        echo '<li>Section = '.$section.' and value = '.$value.' NOT CHANGE: because not found on DB tabel</li>';
                    }

                }else{
                    echo 'On DB tabel error change value='.$value;
                }
            }
        }else{
            header('HTTP/1.0 304 Not Modified', true, 304);
        }

    }
}else if(isset($_POST['exit'])){
    if($_POST['exit']=='ok'){
        setcookie('nickname', '',time()-10,'/');
    }
}else if(isset($_POST['lang'])){
    if($_POST['lang']=='ru'){
        setcookie('lang', 'ru',time()+2678400,'/');
    }else{
        setcookie('lang', 'he',time()+2678400,'/');
    }
}else if(isset($_POST['FakeRemove'])){
    $person = $_POST['person'];
    $removedId = $_POST['RemovedId'];
    $sql = "INSERT INTO `FakeRemove` (person,removedId) VALUE ('$person','$removedId');";
    if($query = $db->con->query($sql)){
        echo "OK";
    }else{
        echo "error";
    }
}else if(isset($_POST['indicClear'])){
    $sql="DELETE FROM `FakeRemove`;";
    if($db->con->query($sql)){
        echo "ok";
    }else{
        echo "error";
    }
}else{
    header('HTTP/1.0 400 Bad Request', true, 400);
    die;
}
?>