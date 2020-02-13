<!DOCTYPE html>
<?php
if (isset($_COOKIE['lang'])){
if($_COOKIE['lang']=='ru'){
    echo '<html lang="ru">';
}else{
    echo '<html lang="iw">';
}
}else if(empty($_COOKIE['lang'])){
    echo '<html lang="ru">';
}
?>

<head>
    <title>NDI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
