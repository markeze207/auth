<? 
require_once('bd.php');

$query = mysqli_query($link, "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 0,10");
$row = mysqli_num_rows($query);
if (!$row) {
    echo 'no';
    exit();
}
else {
    while ($result = mysqli_fetch_assoc($query)) {?>
        <h1>Author: <?=$result['name']?> <br></h1>
        <h3>Title: <?=$result['title']?> <br></h3>
        <p><?=$result['text']?></p>
        <p>Date <?=$result['date']?><br></p>
    <?}
    ?><a href="../index">Back</a><?
    exit();
}

mysqli_close($link);