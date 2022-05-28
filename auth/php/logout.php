<? 
setcookie('user', $info_user['login'], time() - 3600, "/lillego.ml");
header('Location: /lillego.ml/code/index.php');
