<?php
if(!root){
    define('root',$_SERVER['DOCUMENT_ROOT']);
}
require_once root.'/function/db.php';
require_once root.'/function/function.php';

$db = new db();
include_once root.'/head.php';
if (isset($_COOKIE['lang'])){
    if($_COOKIE['lang']=='ru'){
        $dataLoad = loadRu('ru');
    }else{
        $dataLoad = loadRu('he');
    }
}else if(empty($_COOKIE['lang'])){
    $dataLoad = loadRu('ru');
}
?>

<body>
<div id="app">
<div class="container-fluid">
    <?php include root.'/nav.php'; ?>
    <div class="tab-content">
        <div id="all" class="tab-pane fade">
            <div class="well well-lg">
                <h2><img src="/img/001-folder.png" class="icons-lg" alt=""> {{ menualldata }}</h2>
                <p id="alldataerror"></p>
                <div class="table-responsive">
                    <table class="table">
                        <thead><tr>
                            <th>{{allDataTabelNum}}</th>
                            <th>{{allDataTabelElections}}</th>
                            <th>{{allDataTabelComment_2}}</th>
                            <th>{{allDataTabelComment_1}}</th>
                            <th>{{allDataTabelRing_3}}</th>
                            <th>{{allDataTabelRing_2}}</th>
                            <th>{{allDataTabelRing_1}}</th>
                            <th>{{allDataTabeldontSay}}</th>
                            <th>{{allDataTabelnoAnswer}}</th>
                            <th>{{allDataTabelnotGo}}</th>
                            <th>{{allDataTabelnotSelect}}</th>
                            <th>{{allDataTabelNO}}</th>
                            <th>{{allDataTabelbuilding}}</th>
                            <th>{{allDataTabelApartments}}</th>
                            <th>{{allDataTabelHome}}</th>
                            <th>{{allDataTabelStrit}}</th>
                            <th>{{allDataTabelN_in_section}}</th>
                            <th>{{allDataTabelSection}}</th>
                            <th>{{allDataTabelphone}}</th>
                            <th>{{allDataTabelSurname}}</th>
                            <th>{{allDataTabelName}}</th>
                            <th>{{allDataTabelID}}</th>
                            <th>{{allDataTabelResponsible}}</th>
                            <th>{{allDataTabelnewTel}}</th>
                            <th>{{allDataTabelN}}</th>
                            <th>{{allDataTabelControl}}</th>
                        </tr></thead>
                        <tbody id="alldata">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="42000" class="tab-pane fade">
            <div class="well well-lg">
                <h2><img src="/img/002-folder-1.png" class="icons-lg" alt="">{{ menu42000 }}</h2>
                <p id="db42error"></p>
                <div class="table-responsive">
                    <table class="table">
                       <thead><tr>
                           <th>{{allDataTabelNum}}</th>
                           <th>{{allDataTabelElections}}</th>
                           <th>{{allDataTabelbuilding}}</th>
                           <th>{{allDataTabelApartments}}</th>
                           <th>{{allDataTabelHome}}</th>
                           <th>{{allDataTabelStrit}}</th>
                           <th>{{allDataTabelN_in_section}}</th>
                           <th>{{allDataTabelSection}}</th>
                           <th>{{allDataTabelSurname}}</th>
                           <th>{{allDataTabelName}}</th>
                           <th>{{allDataTabelID}}</th>
                       </tr></thead>
                        <tbody id="db42">

                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="statistic" class="tab-pane fade">
            <div class="well well-lg">
                <h2><img src="/img/003-diagram.png" class="icons-lg" alt=""> {{menuStatistic}}</h2>
                <div id="stat">
                    <img src="/img/loader.gif" width="30" height="30" alt="loader">
                </div>
            </div>
        </div>
        <div id="statistic2" class="tab-pane fade">
            <div class="well well-lg">
                <h2><img src="/img/003-diagram.png" class="icons-lg" alt=""> {{menuStatistic}} 2</h2>
                <div id="stat2">
                    <img src="/img/loader.gif" width="30" height="30" alt="loader">
                </div>
            </div>
        </div>
        <div id="indic" class="tab-pane fade in active">
            <div class="well well-lg">
                <h3><img src="/img/004-very-high-pressure.png" class="icons-lg" alt=""> {{menuIndicator}}</h3>
                <a href="javascript:indicLoad();" data-toggle="tooltip" title="manual refresh"><span class="glyphicon glyphicon-refresh"></span>
                    <?php
                    $localtime_assoc = localtime(time(), true);
                    $hour = $localtime_assoc['tm_hour'];
                    $min = $localtime_assoc['tm_min'];
                    $hour = $hour+8;
                    if($hour>=24){
                        $hour=$hour-24;
                    }
                    echo ' '.$dataLoad['timeUpdate'].': '.$hour.':'.$min;
                    ?></a>
                <div class="flex-container" id="indicResult">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include root.'/footer.php'; ?>
</body>
</html>