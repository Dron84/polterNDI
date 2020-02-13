<?php
define('root',$_SERVER['DOCUMENT_ROOT']);
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
//if (isset($_POST['pieChart'])){
//    $title = $_POST['title'];
//    $id = $_POST['id'];
//    $alldata = $_POST['alldata'];
//    $allElections = $_POST['allElections'];
//    $db = $_POST['db'];
//    $dbElections = $_POST['dbElections'];
//}
$dataPoints = array(
    array("label"=>$dataLoad['staticTableCity'], "y"=>$db),
    array("label"=>$dataLoad['staticTableRusSpeech'], "y"=>$alldata)
);
$dataPoints2 = array(
    array("label"=>$dataLoad['staticTableCity'], "y"=>$dbElections),
    array("label"=>$dataLoad['staticTableRusSpeech'], "y"=>$allElections)
);
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>pieChart <?php echo $id;?></title>
    <script>
        var chart_<?php echo $id;?> = new CanvasJS.Chart("chartContainer_<?php echo $id;?>", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "<?php echo $title;?>"
            },
            data: [{
                type: "pie",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "#36454F",
                indexLabelFontSize: 18,
                indexLabelFontWeight: "bolder",
                showInLegend: true,
                legendText: "{label}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart_<?php echo $id;?>.render();
        var chart_<?php echo $id;?>_2 = new CanvasJS.Chart("chartContainer_<?php echo $id;?>_2", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "<?php echo $title;?>"
            },
            data: [{
                type: "pie",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontColor: "#36454F",
                indexLabelFontSize: 18,
                indexLabelFontWeight: "bolder",
                showInLegend: true,
                legendText: "{label}",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart_<?php echo $id;?>_2.render();
    </script>
</head>
<body>
<h3><?php echo $dataLoad['staticTableTotal'];?></h3>
<div id="chartContainer_<?php echo $id;?>" style="height: 370px; width: 100%;"></div>
<h3 style="margin-top: 50px;"><?php echo $dataLoad['allDataTabelElections'];?></h3>
<div id="chartContainer_<?php echo $id;?>_2" style="height: 370px; width: 100%;"></div>
</body>
</html>

