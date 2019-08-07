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
    require_once '../src/Models/Transfer/Transfer.php'; // модель перевода групп
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
                    $id = $birthdate1->id[transfergroup]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[transfergroup];
                    $smalltext = $birthdate1->columns2[smalltransfergroup];
                    ?>

                    <a href="/admin/brithdate/edittitle.php?lessontitle=<?php echo $id ?>">
                        <h1>
                            <?php echo $title; ?>
                            <small><?php echo $smalltext; ?></small>
                        </h1>
                    </a>
                </div>
                <!-- основная часть -->

                <table id="customers" cellspacing="0" border="1" width="500">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: center;">Перевести все классы??</th>
                        </tr>
                        <tr>
                            <th scope="col" width="50%"></th>
                            <th scope="col" width="50%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="col-lg-12">
                                    <form action="" method="POST">
                                        <button type="submit" name="save" class="btn btn-primary col-xs-12 center">На
                                            класс выше +1</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="col-lg-12">
                                    <form action="" method="POST">
                                        <button type="submit" name="save2" class="btn btn-primary col-xs-12 center">На
                                            класс ниже -1</button>
                                    </form>
                                </div>
                            </td>


                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="col-lg-12">
                                    <?php
                                    $transfer = new Birthdate\Transfer();
                                    if (isset($_POST['save'])) {
                                        $transfer->postsave();
                                    }
                                    if (isset($_POST['save2'])) {
                                        $transfer->postsave2();
                                    }
                                    ?>
                                </div>
                            </td>

                        </tr>
                    </tbody>
            </div>
            </table>

        </div>
    </div>
    </div>
</body>


</html>