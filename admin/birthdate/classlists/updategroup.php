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
    require_once '../src/Models/EditSelect/EditSelect.php'; // модель редактирования групп
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
                    $id = $birthdate1->id[updategroup]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[updategroup];
                    $smalltext = $birthdate1->columns2[smalleupdategroup];
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
                            <th colspan="2" style="text-align: center;">Редактировать группу</th>
                        </tr>
                        <tr>
                            <th scope="col" width="100%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //select    
                        $id = $_GET['id'];
                        $class = new Birthdate\EditSelect();
                        $class->id = $id;
                        $class->select();
                        ?>
                        <tr>
                            <td colspan="2">
                                <div class="col-lg-12">
                                    <form action="" method="POST">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-xs-3 col-form-label mr-2">Редактировать класс</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="stage" name="stage" value="<?php echo $class->stage; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-xs-3 col-form-label mr-2">Редактировать букву
                                                класса</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $class->title; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-xs-3 col-xs-9">
                                                <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>

                                    <?php
                                    //save
                                    if (isset($_POST['save'])) {
                                        $class = new Birthdate\EditSelect();
                                        $class->id = $id;
                                        $class->editstage = $_POST['stage'];
                                        $class->edittitle = $_POST['title'];
                                        $class->save();
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>