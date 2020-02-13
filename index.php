<?php
/**
 * Created by PhpStorm.
 * User: Dron84
 * Date: 05.10.2018
 * Time: 10:01
 * AutorSite: uniquesite.ru
 */

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('root',$_SERVER['DOCUMENT_ROOT']);
if(isset($_COOKIE['nickname'])){
    if(isset($_COOKIE['group'])){
        if($_COOKIE['group']!='3'){
            include root.'/main.php';
        }else{
            include root.'/FakeMain.php';
        }

    }

}else{
    include root.'/login.php';
}
?>