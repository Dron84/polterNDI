<?php
//define('root',$_SERVER['DOCUMENT_ROOT']);
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
                            <th>{{allDataTabelID}}
                                <input type="text" id="searchAllDataID">
                            </th>
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
                    <table class="table" id="table42">
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
                           <th>{{allDataTabelID}}
                               <input type="text" id="search42ID">
                           </th>
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
<!--        <div id="responsible" class="tab-pane fade">-->
<!--            <div class="well well-lg">-->
<!--                <h3>{{menuRespond}}</h3>-->
<!--                --><?php //include_once 'function/responsable.php' ?>
<!--                <h4>{{dataInDB}}</h4>-->
<!--                <div class="table-responsive">-->
<!--                    <table class="table">-->
<!--                        <thead><tr>-->
<!--                            <th>{{allDataTabelNum}}</th>-->
<!--                            <th>{{respodID}}</th>-->
<!--                            <th>{{respodName}}</th>-->
<!--                            <th>{{respodAddress}}</th>-->
<!--                            <th>{{respodTel}}</th>-->
<!--                        </tr></thead>-->
<!--                        <tbody id="res_load">-->
<!---->
<!---->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
        <div id="indicator" class="tab-pane fade">
            <div class="well well-lg">
                <h3><img src="/img/004-very-high-pressure.png" class="icons-lg" alt=""> {{menuIndicator}}</h3>
                <a href="javascript:indicatorLoad();" data-toggle="tooltip" title="manual refresh"><span class="glyphicon glyphicon-refresh"></span>
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

                <div class="flex-container" id="indicatorResult">

                </div>
            </div>
        </div>
        <div id="enterdata" class="tab-pane fade">
            <div class="well well-lg">

                <h3><img src="/img/005-text-field.png" class="icons-lg" alt="">{{menuEnterData}}</h3>
                <div class="input-group">
                    <label for="section">{{selectSection}}</label>
                    <select class="form-control" id="section">
                        <option value="null">{{selection}}</option>
                        <?php
                        $sql = "SELECT DISTINCT `Section` FROM `alldata` WHERE section>0 ORDER BY Section;";
                        if($query=$db->con->query($sql)){
                            while($row=$query->fetch_assoc()){
                                echo "<option value='".$row['Section']."'>".$row['Section']."</option>";
                            }
                        }else{
                            echo "error: db";
                        }
                        ?>
                    </select>
                    <input type="text" class="form-control" id="elections" :placeholder="electionPlaseholder">
                </div>

                <div class="input-group">
                    <input type="button" :value="buttonAdd" name='enterdata' class="form-control btn-default">
                </div>
                <p id="submitenterdataerror"></p>
            </div>
                <?php if(isset($_COOKIE['group'])){
                    if($_COOKIE['group']=='4'){
                        echo '<div class="well well-lg"><a href="javascript:indicLoad();" data-toggle="tooltip" title="manual refresh"><span class="glyphicon glyphicon-refresh"></span>';
                        $localtime_assoc = localtime(time(), true);
                        $hour = $localtime_assoc['tm_hour'];
                        $min = $localtime_assoc['tm_min'];
                        $hour = $hour+8;
                        if($hour>=24){
                            $hour=$hour-24;
                        }
                        echo ' '.$dataLoad['timeUpdate'].': '.$hour.':'.$min;
                        echo '</a><br><a href="javascript:indicClear();"><i class="glyphicon glyphicon-ban-circle"></i> Clear</a>
                            <div class="flex-container" id="indicResult">';
                        include root.'/function/indic.php';
                        echo '</div></div>';
                    }
                }?>

        </div>
        <div id="settings" class="tab-pane fade in active">
            <div class="well well-lg">
                <h2><img src="/img/006-settings.png" class="icons-lg" alt="">{{menuSettings}}</h2>
                <h2>{{addUserInDB}}</h2>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login" type="text" class="form-control" name="login" :placeholder="Login">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" id="password" :placeholder="Password">
                        <input type="hidden" name="password">
                    </div>
                <br>
                    <div class="input-group">
                        <button type="submit" id="submit" name='usersadd' class="form-control btn-default"><img src="/img/007-add.png" class="icons" alt="">{{buttonAdd}}</button>
                    </div>
                <p id="submiterror"></p>
                <h2>{{allUserInDB}}</h2>
                <div class="table-responsive">
                    <table class="table" id="userstable">

                    </table>
                </div>
            </div>
<!--            <div class="well well-lg">-->
<!--                --><?php
////                $csv =csvToArray(root.'/42000.csv');
////                print_r($csv);
////                $data = file_get_contents(root.'/42000.csv');
////                $data = explode('\r\n',$data);
////                print_r($data);
////                if ($data) {
////                    $new_data=str_getcsv($data,';','','');
////                    print_r($new_data);
////                } else {
////                    die("Unable to open file");
////                }
//
//
//
//                ?>
<!--            </div>-->
        </div>

    </div>
</div>
</div>
<?php include root.'/footer.php'; ?>
</body>
</html>