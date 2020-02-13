<?php ?>
<form action="/function/post.php" method="post">
<div class="input-group">

    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="res_id" type="text" class="form-control" name="res_id" :placeholder="respodID" maxlength="10">

    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="res_name" type="text" class="form-control" name="res_name" :placeholder="respodName" maxlength="35">

    <span class="input-group-addon">{{respodAddress}}</span>
    <input id="res_address" type="text" class="form-control" name="res_address" :placeholder="respodAddress" maxlength="250">

    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
    <input id="res_tel" type="text" class="form-control" name="res_tel" :placeholder="respodTel" maxlength="15">
</div>
<div class="container-fluid">
    <br>

    <div class="row">
        <div class="col-md-4">
            <div class="well">
                <input name="pep_id" type="hidden">
                <div data-add="1"></div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" placeholder="ID" id="pep_id" maxlength="10">
                    <span class="input-group-addon btn-success" id="check"><i class="glyphicon glyphicon-eye-open"></i> {{Check}}</span>
                </div>

                <br>
                <button type="button" class="btn btn-success" id="addPeople" disabled="disabled"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
        </div>

        <div class="well col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <thead><tr>
                        <th>{{respodID}}</th>
                        <th>{{respodName}}</th>
                        <th>{{respodAddress}}</th>
                        <th>{{respodTel}}</th>
                    </tr></thead>
                    <tbody id="pep_check">


                    </tbody>
                </table>

            </div>
        </div>
    </div>
        <button class="btn btn-success" name="submit" value="all_save" id="all_save" disabled="disabled"> {{Save}}</button>
    </form>
</div>
