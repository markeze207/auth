<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="root" >
        <?php 
            if($_COOKIE['user'] == '') :
        ?>
        <div class="wrapper">
            <div class="container">
                <form action="php/login.php" method="post">
                    <div class="form">
                        <h1>genius.site</h1>
                        <div class="input-form-login">
                            <input required type="text" placeholder="кLogin" name="login">
                        </div>
                        <div class="input-form-pass">
                            <input required type="password" placeholder="Password" name="pass">
                        </div>
                        <a href="forgot.html" class="forget">Forgot password??</a>
                        <a href="new.html" class="new">Don't have an account?</a>
                        <div class="input-form-submit">
                            <input type="submit" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php else:?>
            <div class="form">
                <h1> Welcome, <?=$_COOKIE['user'] ?></h1>
                <form action="change.html">
                    <div class="change-pass">
                        <input type="submit" value="Change pass">
                    </div>
                </form>
                <div class="input-form-submit-1">
                        <a class="button1" href="add.html"><button>Add news <br></button></a>
                        <a href="php/news.php"><button>News</button></a>
                </div> 
                <form action="php/logout.php" method="post">
                    <div class="input-form-submit-2">
                        <input type="submit" value="Logout">
                    </div>
                </form>
            </div>
        <?php endif;?>
    </div>
</body>
</html>