<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="ATolkachev">
    <meta name="description" lang="ru" content="Админ Панель">
    <meta name="description" lang="eng" content="Admin Panel">
    <!--meta -->
    <title> ADMIN INFORMATION SCREEN </title>
    <link rel="stylesheet" type="text/css" href="/admin/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/admin/css/local.css" />
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.css" />
    <script src="../js/buttonhiden.js"></script>
</head>

<body>
    <?php
    require_once '../src/Models/Edittitle/Edittitle.php'; // модель выгрузки заголовков из бд
    require_once '../src/Models/Fulldeletestud/Fulldeletestud.php'; // модель удаления клиента
    ?>
    <div id="wrapper">
        <!-- sidebar для student -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="/admin/birthdate/index.php">
                        <i class="fa fa-tasks"></i> Главная
                    </a>
                </li>
                <li>
                    <a href="/admin/index.php">
                        <i class="fa fa-tasks"></i> Назад в админ панель
                    </a>
                </li>
                <li>
                    <a href="/index.php">
                        <i class="fa fa-tasks"></i> На страницу с экраном
                    </a>
                </li>
            </ul>
        </nav>



        <div class="col-lg-12">
            <div id="page-wrapper">
                <!-- надпись -->
                <div>
                    <?php
                    $birthdate1 = new Birthdate\Edittitle();
                    $birthdate1->headertitle();
                    $id = $birthdate1->id[insertst]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[insertst];
                    $smalltext = $birthdate1->columns2[smallinsertst];
                    ?>

                    <a href="/admin/brithdate/edittitle.php?lessontitle=<?php echo $id ?>">
                        <h1>
                            <?php echo $title; ?>
                            <small><?php echo $smalltext; ?></small>
                        </h1>
                    </a>
                </div>

                <table id="customers" cellspacing="0" border="1" width="500">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: center;">Добавить ученика</th>
                        </tr>
                        <tr>
                            <th scope="col" width="100%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="col-lg-12">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-xs-3 col-form-label mr-2">Фамилия</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="fname" name="fname" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Имя </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="lname" name="lname" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Отчество </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="mname" name="mname" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Дата рождения </label>
                                            <div class="col-xs-9">
                                                <input type="date" class="form-control" id="date" name="date" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Телефон </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="tel" name="tel" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Фото </label>
                                            <div class="col-xs-9">
                                                <input type="file" class="" id="file" name="file" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-xs-3 col-xs-9">
                                                <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>
                            </td>
                        </tr>


                    </tbody>


            </div>
            </table>

        </div>

</body>

</html>
<?php
// процедурный стиль
include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
$imgDir = 'uploads/';      // каталог для хранения изображений 
@mkdir($imgDir, 0777);  // создаем, если его еще нет 

// Проверяем, нажата ли кнопка добавления фотографии. 
if (isset($_POST['save'])) {
    $data = $_FILES['file'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['lname'];
    $date = $_POST['date'];
    $date2 = date("d.m.Y", strtotime($date));
    $tel = $_POST['tel'];
    $tmp = $data['tmp_name'];
    $d = $_GET['studentid'];
    // Проверяем, принят ли файл. 
    if (@file_exists($tmp)) {
        $info = @getimagesize($_FILES['file']['tmp_name']);
        // Проверяем, является ли файл изображением. 
        if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
            include('classSimpleImage.php');
            $image = new SimpleImage();
            $image->load($_FILES['file']['tmp_name']);
            $image->resize(200, 200);
            $image->save($_FILES['file']['tmp_name']);
            // Имя берем равным текущему времени в секундах, а 
            // расширение - как часть MIME-типа после "image/". 
            $name = "$imgDir" . time() . "." . $p[1];
            $name2 = 'uploads/' . time() . "." . $p[1];
            $name3 = 'img/' . time() . "." . $p[1];

            echo "<label class='form-control'>$name2</h2></label>";

            $ares = mysqli_query($mysqli, "INSERT INTO `student` (`fname`, `lname`, `mname`, `birthdate`, `tel`, `photochash`, `studentid`) VALUES ('$fname', '$lname', '$mname', '$date2', '$tel', '$name2', $d);");
            //echo $ares;
            // $result = mysql_query("select * from proba WHERE id = '1'");
            //    $row = mysql_fetch_array($result);
            //    $dir='';

            // удаляем файл
            //      unlink($dir.'../../'.$row[4]);
            //  $qry= "update proba SET images ='$name2', img ='$name3', metka = '$metka' WHERE id='1'";

            //  $result=mysql_query($qry, $db);


            // Добавляем файл в каталог с фотографиями. 
            move_uploaded_file($tmp, $name);
            echo '<META HTTP-EQUIV=Refresh Content="0;URL=lists.php?studentid=' . $d . '">';
        } else {
            echo "<label class='form-control'> Попытка добавить файл недопустимого формата!</label>";
        }
    } else {
        echo " <label class='form-control'> Ошибка закачки #{$data['error']}!</label>";
    }
}

// Теперь считываем в массив наш фотоальбом. 
$photos = array();
foreach (glob("$imgDir*") as $path) {
    $sz = getimagesize($path); // размер 
    $tm = filemtime($path);    // время добавления 
    // Вставляем изображение в массив $photos. 
    $photos[$tm] = array(
        'time' => $tm,              // время добавления 
        'name' => basename($path),  // имя файла 
        'url'  => $path,            // его URI 
        'w'    => $sz[0],           // ширина картинки 
        'h'    => $sz[1],           // ее высота 
        'wh'   => $sz[3]            // "width=xxx height=yyy" 
    );
}
// Ключи массива $photos - время в секундах, когда была добавлена 
// та или иная фотография. Сортируем массив: наиболее "свежие" 
// фотографии располагаем ближе к его началу. 
krsort($photos);
//var_dump($photos);
// Данные для вывода готовы. Дело за малым - оформить страницу. 



//mysql_query("INSERT INTO `studentgroup` (`stage`, `title`, `studentid`) VALUES ($stage, '$title', $timestamp);");
//$metka = time(); 
//mysql_query("INSERT INTO `label` (metka) VALUES ('$metka')"); 

// echo '<META HTTP-EQUIV=Refresh Content="0;URL=index.php">';

?>