<?

require_once('bd.php');

$time = time();
$today = date("Y-m-d H:i:s",$time);

$name = filter_var(trim($_COOKIE['user']));
$title = filter_var(trim($_POST['title']));
$text = filter_var(trim($_POST['text']));

$link->query("INSERT INTO `post`(`name`, `title`, `text`,`date`) VALUES ('$name','$title','$text','$today')");
header('Location: /lillego.ml/code/php/news');
mysqli_close($link);
exit();