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
                    $id = $birthdate1->id[deletest]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[deletest];
                    $smalltext = $birthdate1->columns2[smalldeletest];
                    ?>

                    <a href="/admin/brithdate/edittitle.php?lessontitle=<?php echo $id ?>">
                        <h1>
                            <?php echo $title; ?>
                            <small><?php echo $smalltext; ?></small>
                        </h1>
                    </a>
                </div>

                <?php
                $deletest1 = new Birthdate\Deletestud();
                $deletest1->id = $_GET['id'];
                $deletest1->imgdelete();
                $deletest1->deldstud();
                ?>

            </div>
        </div>
    </div>
</body>

</html>