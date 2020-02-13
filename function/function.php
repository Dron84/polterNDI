<?php
//define('root', $_SERVER['DOCUMENT_ROOT']);
function loadRu($lang){
    $data = file_get_contents(root."/lang/".$lang.".js");
    $data = substr($data,47,-5);
    $data = explode(',', $data);
    foreach ($data as $value){
        $v = explode(':',$value);
        $key = trim($v[0]);
        $val = substr(trim($v[1]),1,-1);
        $r[$key]=$val;
    }
    return $r;
}
function csvToArray($file) {
    $rows = array();
    $headers = array();
    if (file_exists($file) && is_readable($file)) {
        $handle = fopen($file, 'r');
        while (!feof($handle)) {
            $row = fgetcsv($handle, 10240, ',', '"');
            if (empty($headers))
                $headers = $row;
            else if (is_array($row)) {
                array_splice($row, count($headers));
                $rows[] = array_combine($headers, $row);
            }
        }
        fclose($handle);
    } else {
        throw new Exception($file . ' doesn`t exist or is not readable.');
    }
    return $rows;
}
function normolizeAlldataSection(){
    $sql="SELECT Section,ID FROM `alldata` WHERE section>100 AND Section <990";
    if($query = $db->con->query($sql)){
        while($row=$query->fetch_assoc()){
            $row['Section']=substr($row['Section'],0,-1);
            $sql2 = "UPDATE `alldata` SET Section='".$row['Section']."' WHERE ID='".$row['ID']."'";
            $db->con->query($sql2);
        }
    }
}