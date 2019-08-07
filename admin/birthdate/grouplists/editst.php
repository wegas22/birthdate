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
    require_once '../src/Models/Deletestud/Deletestud.php'; // модель удаления клиента
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
                    $id = $birthdate1->id[updatest]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[updatest];
                    $smalltext = $birthdate1->columns2[smallupdatest];
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
                            <th colspan="2" style="text-align: center;">Редактировать ученика</th>
                        </tr>
                        <tr>
                            <th scope="col" width="100%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //процедурный переделать.
                        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
                        $id = $_GET['id'];
                        $result = mysqli_query($mysqli, "SELECT * FROM `student`, `studentgroup` WHERE student.studentid = studentgroup.studentid and student.id = $id");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <tr>
                            <td colspan="2">
                                <div class="col-lg-12">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-xs-3 col-form-label mr-2">Фамилия</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row[fname]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Имя </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row[lname]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Отчество </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $row[mname]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Дата рождения </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="date" name="date" value="<?php echo $row[birthdate]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Телефон </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $row[tel]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Фото </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="photochash" name="photochash" value="<?php echo $row[photochash]; ?>" readonly>
                                                <input type="file" class="" id="file" name="file" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-xs-3 col-xs-9">
                                                <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-xs-3 col-xs-9">
                                                <?php echo "<a  class='btn btn-primary' href='lists.php?studentid=$row[studentid]'>Назад</a>"; ?>
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
//переместить в модель
class Editst
{
    public $dir;
    public $photo;
    public $file;
    public $fname;
    public $lname;
    public $mname;
    public $date;
    public $tel;
    public $tmp;
    public $studentid;
    public $id;
    public $height;
    public $width;
    //переменная из функции save();
    public $filename;

    //функция сохранения файла
    public function save()
    {
        // если нажата кнопка
        if (isset($_POST['save'])) {
            //если темповый файл существует
            if (@file_exists($this->tmp)) {
                //var_dump(getimagesize($this -> tmp)); // проверка принятого файла
                $info = getimagesize($this->tmp);
                // проверяем является ли файл изображением
                if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
                    //обрабатываем через класс изменяем размер
                    include 'classSimpleImage.php';
                    $image = new SimpleImage();
                    $image->load($this->tmp);
                    $image->resize($this->width, $this->height);
                    $image->save($this->tmp);
                    //записываем файл в папку
                    $filename = $this->dir . time() . '.' . $p[1];
                    //записываем называние переменной
                    $this->filename = $filename;
                    move_uploaded_file($this->tmp, $filename);
                    //echo $filename;
                }
            }
        }
    }

    //функция записи в бд с фото
    public function mysqlsave()
    {
        if (isset($_POST['save'])) {
            include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
            $sql = mysqli_query($mysqli, "UPDATE student SET fname = '{$this->fname}', lname='{$this->lname}', mname='{$this->mname}', birthdate='{$this->date}', tel='{$this->tel}', photochash='{$this->filename}', studentid='{$this->studentid}' WHERE id='{$this->id}'");
            //echo $sql = mysql_query("INSERT INTO student (fname, lname, mname, birthdate, tel, photochash, studentid) VALUES('{$this->fname}', '{$this->lname}', '{$this->mname}','{$this->date}', '{$this->tel}', '{$this->filename}','{$this->studentid}')");
            echo "<META HTTP-EQUIV=Refresh Content='0;URL=lists.php?studentid={$this->studentid}'>";
            //echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
        }
    }

    //функция записи в бд без фото
    public function mysqlsave2()
    {
        if (isset($_POST['save'])) {
            include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
            $sql = mysqli_query($mysqli, "UPDATE student SET fname = '{$this->fname}', lname='{$this->lname}', mname='{$this->mname}', birthdate='{$this->date}', tel='{$this->tel}', studentid='{$this->studentid}' WHERE id='{$this->id}'");
            //echo $sql = mysql_query("INSERT INTO student (fname, lname, mname, birthdate, tel, photochash, studentid) VALUES('{$this->fname}', '{$this->lname}', '{$this->mname}','{$this->date}', '{$this->tel}', '{$this->filename}','{$this->studentid}')");
            echo "<META HTTP-EQUIV=Refresh Content='0;URL=lists.php?studentid={$this->studentid}'>";
            //echo "<META HTTP-EQUIV=Refresh Content='0;URL=editst.php?studentid={$this->studentid}&id={$this->id}'>";
            // echo "<html><head><meta http-equiv='Refresh' content='0; URL=" . $_SERVER['HTTP_REFERER'] . "'></head></html>";
        }
    }

    //Вся Логика тут!! удалить и сохранить новый файл...
    public function delsave()
    {
        // если нажата кнопка
        if (isset($_POST['save'])) {
            //если в базе отсутствует фото
            if (($this->photo) == null) {
                //если файл загружен
                if (@file_exists($this->tmp)) {
                    //запускаем функцию сохранения
                    $this->save();
                    //сохраняем запись в бд
                    $this->mysqlsave();
                }
                //иначе
                else {
                    //сохраняем запись в бд без файла
                    $this->mysqlsave2();
                }
            }
            //если в базе существует файл
            else {
                //если файл загружен
                if (@file_exists($this->tmp)) {
                    //сохраняем файл
                    $this->save();
                    //берем название файла
                    $dir = $this->photo;
                    //если файл существует
                    if (file_exists($dir)) {
                        //удаляем
                        $del = unlink($dir);
                        //echo 'Удалено: '.$dir.' Статус удаления:'. $del. '</br>';
                    }
                    //сохраняем в бд
                    $this->mysqlsave();
                }
                //иначе
                else {
                    //сохраняем в бд без файла
                    $this->mysqlsave2();
                }
            }
        }
    }
}
if (isset($_POST['save'])) {
    $member = new Editst();
    //директрория
    $member->dir = 'uploads/';
    //старая фотография
    $member->photo = $row[photochash];
    $member->date = date('d.m.Y', strtotime($_POST['date']));
    $member->fname = $_POST['fname'];
    $member->lname = $_POST['lname'];
    $member->mname = $_POST['mname'];
    $member->file = $_FILES['file'];
    $member->tel = $_POST['tel'];
    $member->tmp = $member->file['tmp_name'];
    $member->studentid = $_GET['studentid'];
    $member->id = $_GET['id'];
    $member->height = 200;
    $member->width = 200;

    $member->delsave();
}
?>