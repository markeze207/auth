<? 
require_once('bd.php');
$query = mysqli_query($link, "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 0,10");
$row = mysqli_num_rows($query);
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
$info = mysqli_fetch_assoc($link->query("SELECT * FROM `post` WHERE url = '".$url."'"));
if($info) {
    ?>
        <h1>Author: <?=$info['name']?> <br></h1>
        <h3>Title: <?=$info['title']?> <br></h3>
        <p><?=$info['text']?></p>
        <?
        if($info['path'] != '') {
            ?><img src="../php/img/<?=$info['path']?>" width="500px"><br><br>
        <?}
        ?>
        <p>Date <?=$info['date']?><br></p>
        <a href="../php/news">Back</a>
    <?
    exit();
}
if (!$row) {
    echo 'no';
    exit();
}
else {
    while ($result = mysqli_fetch_assoc($query)) {?>
        <h1>Author: <?=$result['name']?> <br></h1>
        <h3>Title: <?=$result['title']?> <br></h3>
        <p><?=$result['text']?></p>
        <?
        if($result['path'] != '') {
            ?><img src="../php/img/<?=$result['path']?>" width="500px"><br><br>
        <?}
        ?>
        <a href="<?=$result['url']?>">Visible post<br></a>
        <p>Date <?=$result['date']?><br></p>
    <?}
    ?><a href="../index">Back</a><?
    exit();
}

mysqli_close($link);