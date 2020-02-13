<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="mynav">
            <ul class="nav navbar-nav" id="nav">
                <?php
                if(isset($_COOKIE['group'])){
                    if($_COOKIE['group']!='3'){
                        echo '<li><a data-toggle="tab" href="#all">
                        <img src="/img/001-folder.png" class="icons" alt="">{{ menualldata }}</a></li>
                        <li><a data-toggle="tab" href="#42000"><img src="/img/002-folder-1.png" class="icons" alt="">{{ menu42000 }}</a></li>
                        <li><a data-toggle="tab" href="#statistic"><img src="/img/003-diagram.png" class="icons" alt="">{{menuStatistic}}</a></li>
                        <li><a data-toggle="tab" href="#statistic2"><img src="/img/003-diagram.png" class="icons" alt="">{{menuStatistic}} 2</a></li>
        <!--                <li><a data-toggle="tab" href="#responsible">{{menuRespond}}</a></li>-->
                        <li><a data-toggle="tab" href="#indicator"><img src="/img/004-very-high-pressure.png" class="icons" alt="">{{menuIndicator}}</a></li>
                        <li><a data-toggle="tab" href="#enterdata"><img src="/img/005-text-field.png" class="icons" alt="">{{menuEnterData}}</a></li>
                        <li class="active"><a data-toggle="tab" href="#settings"><img src="/img/006-settings.png" class="icons" alt="">{{menuSettings}}</a></li>';
                    }else{
                        echo '<li><a data-toggle="tab" href="#all">
                        <img src="/img/001-folder.png" class="icons" alt="">{{ menualldata }}</a></li>
                        <li><a data-toggle="tab" href="#42000"><img src="/img/002-folder-1.png" class="icons" alt="">{{ menu42000 }}</a></li>
                        <li><a data-toggle="tab" href="#statistic"><img src="/img/003-diagram.png" class="icons" alt="">{{menuStatistic}}</a></li>
                        <li><a data-toggle="tab" href="#statistic2"><img src="/img/003-diagram.png" class="icons" alt="">{{menuStatistic}} 2</a></li>
                        <li><a data-toggle="tab" href="#indic"><img src="/img/004-very-high-pressure.png" class="icons" alt="">{{menuIndicator}}</a></li>
                        ';
                    }
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><ul class="dropdown-menu">
                        <li><a href="#russian">русский</a></li>
                        <li><a href="#hewrit">עברית</a></li>
                    </ul>
                    <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-flag"></span> lang</a></li>
                <li><a href="#exit"><span class="glyphicon glyphicon-log-out"></span> {{menuExit}}</a></li>
            </ul>
        </div>
    </div>
</nav>