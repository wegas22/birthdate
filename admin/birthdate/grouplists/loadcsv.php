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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery-1.10.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#upload2').click(function() {

                console.log('upload button clicked!')
                var fd = new FormData();
                fd.append('csvfile', $('#csvfile')[0].files[0]);
                console.log(fd);
                $.ajax({
                    url: 'fopencsv.php',
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {

                        console.log('upload success!')
                        $('#data').empty();
                        $('#data').append(data);

                    }
                });
            });
        });

        $(document).ready(function() {
            $('#upload').click(function() {

                console.log('upload button clicked!')
                var fd = new FormData();
                //var studentid = $('#studentid').val();   
                fd.append('csvfile', $('#csvfile')[0].files[0]);
                fd.append('studentid', $('#studentid').val());
                console.log(fd);
                $.ajax({
                    url: 'zapiscsv.php',
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {

                        console.log('upload success!')
                        $('#data').empty();
                        $('#data').append(data);

                    }
                });
            });
        });
    </script>
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
                    $id = $birthdate1->id[groupcsv]; //вывод переменной на экран из бд
                    $title = $birthdate1->columns[groupcsv];
                    $smalltext = $birthdate1->columns2[smallgroupcsv];
                    ?>

                    <a href="/admin/brithdate/edittitle.php?lessontitle=<?php echo $id ?>">
                        <h1>
                            <?php echo $title; ?>
                            <small><?php echo $smalltext; ?></small>
                        </h1>
                    </a>
                </div>

            </div>


            <div class="col-lg-12">
                <form enctype="multipart/form-data" action="" method="post" id="add-courses">

                    <h3> <label class="label label-default" for="image">Загрузите CSV файл Кодировка UTF8 без BOM: </label></h3>

                    <div class="input-group input-file">

                        <div class="form-control">
                            <a href="test.csv" target="_blank">test.csv</a>
                        </div>

                        <span class="input-group-addon">
                            <a class='btn btn-primary' href='javascript:;'>
                                Открыть
                                <input type="file" name="csvfile" id="csvfile" accept=".csv" value="" onchange="$(this).parent().parent().parent().find('.form-control').html($(this).val());">
                            </a>
                        </span>


                    </div>

                    </br>
                    <input type="text" value="<?php echo $_GET['studentid'] ?>" style="display:none;" id="studentid"></br>
                    <div style='float: right;'>
                        <input class="btn btn-success" type="button" id="upload2" name="uploadCSV" value="Просмотр" />
                        <input class="btn btn-danger" type="button" id="upload" name="uploadCSV" value="Запись" />
                        <input class="btn btn" type="button" onclick="document.location.reload()" id="upload3" value="Обновить" />
                    </div>

                    </br></br></br>


                    <div id="data">
                        <!-- ajax инфа-->
                    </div>

                </form>
            </div>
</body>

</html>