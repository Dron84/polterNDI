<?php include_once root.'/head.php';?>
<body>
<div class="container" id="app">
    <div class="well well-lg" id="loginBlock">
    <h3>{{pleaseLogin}}</h3>
    <form action="/function/post.php" method="post">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login" type="text" class="form-control" name="login" :placeholder="Login">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" :placeholder="Password">
        </div>
        <input type="hidden" name="password">
        <br>
        <div class="input-group">
            <button type="submit" id="submit" value="login" name='loginIn' class="form-control submit">{{LoginIn}}</button>
        </div>
        <?php
            if(isset($_GET['error'])){
                echo "<p style='color: red;'>ERROR: Check login and password </p>";
            }
        ?>
    </form>
    </div>

</div>
<?php include root.'/footer.php'; ?>
</body>
</html>