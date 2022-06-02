<?
require_once('bd.php');
$time = time();
$today = date("Y-m-d H:i:s",$time);
$name = filter_var(trim($_COOKIE['user']));
$title = filter_var(trim($_POST['title']));
$text = filter_var(trim($_POST['text']));
if(!empty($_FILES['file']) and $_FILES['file']['name'] != '') {
  $file = $_FILES['file'];
  $rand = rand(0,1432);
  $namefile = $_COOKIE['user'].$rand.'-'.$file['name'];
  $pathFile = __DIR__.'/img/'.$namefile;
  $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
  if (!in_array($_FILES['file']['type'], $types)){
    echo 'Недопустимый тип файла. Допустимо загружать только изображения: *.gif, *.png, *.jpg';
    exit();
  }
  else {
    if($file['size'] > 5242880) {
      echo 'Недопустимый размер файла. Допустимо загружать до 5мб';
      exit();
    }
    else {
      if(!move_uploaded_file($file['tmp_name'],$pathFile)) {
        echo 'Файл не загружен';
        exit();
      }
    }
  }
}
function fixForUri($string){
    $slug = trim($string); // trim the string
    $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
    $slug= str_replace(' ','-', $slug); // replace spaces by dashes
    $slug= strtolower($slug);  // make it lowercase
    return $slug;
}

function translit($value)
{
  $converter = array(
    'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
    'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
    'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
    'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
    'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
    'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
    'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
 
    'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
    'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
    'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
    'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
    'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
    'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
    'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
  );
 
  $value = strtr($value, $converter);
  return $value;
}
$slug = translit($title);
$slug = fixForUri($slug);
$url = 'http://37.230.113.210/lillego.ml/code/php/'.$slug;
$link->query("INSERT INTO `post`(`name`, `title`, `text`,`date`,`url`,`path`) VALUES ('$name','$title','$text','$today','$url','$namefile')");
header('Location: /lillego.ml/code/php/news');
mysqli_close($link);
exit();