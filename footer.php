<div><a href="#nav" style="font-size: 3.5em;position: fixed;bottom: 20px;right: 50px;"><span class="glyphicon glyphicon-upload" ></span></a></div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="/js/base64.js"></script>
<link rel="stylesheet" href="/css/index.css">
<?php
if (isset($_COOKIE['lang'])){
    if($_COOKIE['lang']=='ru'){
        echo '<script src="/lang/ru.js"></script>';
    }else{
        echo '<script src="/lang/he.js"></script>';
    }
}else if(empty($_COOKIE['lang'])){
   echo '<script src="/lang/ru.js"></script>';
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/jquery.cookie.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/index.js"></script>