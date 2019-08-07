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
    require_once 'src/Models/Edittitle/Edittitle.php'; // модель выгрузки заголовков из бд
    require_once 'src/Models/Studindex/Studindex.php'; // модель вывода групп из бд
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
                    $id = $birthdate1->id[grouplists]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[grouplists];
                    $smalltext = $birthdate1->columns2[smallgrouplists];
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
                            <th colspan="4" style="text-align: center;">Работа со списками классов</th>
                        </tr>
                        <tr>
                            <th scope="col" width="70%">Группа</th>
                            <th scope="col" width="5%">Параллель</th>
                            <th scope="col" colspan="2">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student1 = new Birthdate\Studindex();
                        $student1->selectbrit();

                        foreach ($student1->json as $jsones) {
                            echo "<tr>";
                            echo "<td><a href='grouplists/lists.php?studentid=$jsones[studentid]'>$jsones[stage]$jsones[title]</a></td>";
                            echo "<td>$jsones[stage]</td>";
                            echo "<td><a href='classlists/updategroup.php?id=$jsones[id]'>Редактировать</a></td>";
                            echo "<td><a href='classlists/deletegroup.php?id=$jsones[id]'>Удалить</a></th>";
                            echo "<tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="2"><a href="classlists/insertgroup.php" class="oopadd"> Добавить класс</a></td>
                            <td colspan="2"><a href="classlists/transfergroup.php" class="oopadd"> Перевести все классы</a></td>
                        </tr>
                    </tbody>
                </table>

                <br />
                <div id="box">
                    <button id="btn"> Массив элементов </button>
                </div>

                <?php
                echo '<div id="btnclick" style="display:none;">';

                echo '<pre>';
                $student1 = new Birthdate\Studindex();
                $student1->selectbrit();
                print_r($student1->json);
                $birthdate1 = new Birthdate\Edittitle();
                $birthdate1->headertitle();
                print_r($birthdate1->columns);
                print_r($birthdate1->columns2);
                print_r($birthdate1->id);
                echo '</pre>';

                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</body>

</html>