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
    <link rel="stylesheet" type="text/css" href="/admin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/css/local.css" />
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.wallform.js"></script>
    <script src="js/ajaxjs.js"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
    <link rel="stylesheet" href="css/groupstyle.css">

    <script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">

</head>

<body>
    <?php
    require_once '../src/Models/Edittitle/Edittitle.php'; // модель выгрузки заголовков из бд
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

                <div id="wizardDiv" style="position:fixed; width: 100%; display:none" z-index:998>
                    <div class="container">
                        <div style="background: rgba(128, 131, 138, 0.7); z-index:999; margin: 20 auto;  min-width: 250px; width: 45%;">
                            <button style="float:right" id="exit" class="btn btn-danger">X</button>
                            <ul class="ulstyle">
                                <li style="color:red; list-style-type: none; ">Техническая информация</li>
                                <li style="list-style-type: none; " id='textid'></li>
                                <li style="list-style-type: none; " id='photoid'></li>
                            </ul>
                            <div style="display:block; overflow: auto;" id="upload-demo"></div>
                            <button style="float:right" class="btn btn-success upload-result">Сохранить</button>
                            <button id="rotateLeft" class="vanilla-rotate btn btn-primary" data-deg="-90">Повернуть влево</button>
                            <button id="rotateRight" class="vanilla-rotate btn btn-info" data-deg="90">Повернуть вправо</button>
                        </div>
                    </div>
                </div>
                <!-- основная часть -->
                <table id="customers" cellspacing="0" border="1" width="500">
                    <thead>
                        <tr>
                            <th colspan="8" style="text-align: center;">Работа со списками классов</th>
                        </tr>
                        <tr>
                            <th scope="col" width="5%">tableid</th>
                            <th scope="col" width="50%">ФИО</th>
                            <th scope="col" width="5%">Дата рождения</th>
                            <th scope="col" width="5%">Телефон</th>
                            <th scope="col" width="5%">Класс</th>
                            <th scope="col" width="20%">Фото</th>
                            <th scope="col" colspan="2">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // процедурный стиль переделать
                        //$a = $_GET['stage'];
                        //$b = $_GET['title'];
                        $d = $_GET['studentid'];
                        $sum = 0;
                        include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
                        $result2 = mysqli_query($mysqli, "SELECT * FROM `studentgroup` WHERE studentid = $d");
                        $row2 = mysqli_fetch_array($result2);
                        $a = $row2[stage];
                        //$b = $row2[title];

                        mysqli_query($mysqli, "update student, studentgroup set tableid=@num:=@num+1 where 0 in(select @num:=0) and student.studentid = '$d' and student.studentid = studentgroup.studentid");

                        $result = mysqli_query($mysqli, "SELECT * FROM `student`, `studentgroup` WHERE student.studentid = $d and student.studentid = studentgroup.studentid");
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo "<td>$row[tableid]</td>";
                            echo "<td>$row[fname] $row[lname] $row[mname]</td>";
                            echo "<td>$row[birthdate]</td>";
                            echo "<td>$row[tel]</td>";
                            echo "<td>$row[stage] $row[title]</td>";
                            echo '<td>';
                            if ($row['photochash'] != '0' && $row['photochash'] != null) {
                                echo '<div class="logo" style = "text-align:center">
                                    <img height="40" width="40" src="' . $row[photochash] . '">
                                    </div> ';
                            } else {
                                //echo "<a href='photohach.php?id=$row[id]'>Закачать</a>";
                                echo '
                                    <form action="oneupload.php" method="post" enctype="multipart/form-data">
                                    <div class="form-check" style="text-align:center;">
                                        <label id="' . $row[0] . '">
                                        <input type="file" id="upload' . $row[tableid] . '"><a>Закачать</a>
                                        </label>
                                    </div>
                                    </form>';
                            }
                            echo '</td>';
                            echo "<td><a href='editst.php?studentid=$row[studentid]&id=$row[0]'>Редактировать</a></td>";
                            echo "<td><a href='deletestud.php?id=$row[0]'>Удалить</a></td>";
                            echo '</tr>';
                            $sum = $sum + 1;
                        }

                        //echo $row[stage];


                        ?>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="4">
                                <a href="insertst.php?studentid=<?php echo $d; ?>" class="oopadd">
                                    Добавить ученика
                                </a>
                            </td>
                            <td colspan="1">
                                <a href="fulldeleteimg.php?studentid=<?php echo $d; ?>" class="oopadd">
                                    Удалить фото у всех
                                </a>
                            </td>
                            <td colspan="2">
                                <a href="fulldeletestud.php?studentid=<?php echo $d; ?>" class="oopadd">
                                    Удалить всех
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <form id="imageform" method="post" enctype="multipart/form-data" action='ajaxImageUpload.php' style="clear:both">
                                    <h1>Массовое обновление фотографий</h1>
                                    <div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...." /></div>
                                    <div id='imageloadbutton'>
                                        <input type="text" value="<?php echo $d; ?>" name="studentid" class="form-control" style="display:none" readonly>
                                        <h5>*Фотографии должны быть квадратные</h5>
                                        <h4>Введите tableid фото (далее фотографии зальются по принципу tableid+1)</h4>
                                        <input type="text" value="1" name="id" class="form-control">
                                        <input type="file" name="photos[]" id="photoimg" multiple="true" />
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8">

                                <div id='preview'>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><a href="export.php?studentid=<?php echo $d; ?>" class="oopadd">Скачать выгрузку CSV (без
                                    расположения фото)</a></td>
                            <td colspan="4"><a href="loadcsv.php?studentid=<?php echo $d; ?>" class="oopadd">Массовое добавление CSV (в
                                    класс)</a></td>
                        </tr>
                    </tbody>
                    <div class="content" id="content"></div>

                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $('#wizardDiv').draggable({
        handle: 'ul'
    });
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: false,
        viewport: {
            width: 225,
            height: 229,
            type: 'square'
        },
        boundary: {
            width: 350,
            height: 350
        },
        enableOrientation: true
    });


    sum = <?php echo $sum; ?>;
    for (i = 1; i <= sum; i++) {

        $('#upload' + i).on('change', function() {
            var div = document.getElementById('wizardDiv');
            div.style.display = 'block';
            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    // $('#wizardDiv').draggable();

                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

    }

    //отлавливаем id элемента
    var bid, trid;
    $('input[type=file]').click(function() {

        bid = (this.id); // button ID 
        //trid = $(this).closest('tr').attr('id'); // table row ID 
        trid = $(this).closest('label').attr('id'); // table row ID 
        //alert(trid);
        document.getElementById('photoid').innerHTML = 'photoid:' + bid;
        document.getElementById('textid').innerHTML = 'id элемента:' + trid;
    });
    //закачиваем в базу

    $('.upload-result').on('click', function(ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(resp) {
            //var id = 449;
            var image = resp.split(',');
            console.log(image[0]);
            $.ajax({
                url: "oneupload.php",
                type: "POST",
                data: {
                    "file": image[1],
                    "id": trid
                },
                success: function(data) {
                    console.log(data);
                    var div = document.getElementById('wizardDiv');
                    div.style.display = 'none';
                    var lab = document.getElementById(trid);
                    console.log(lab)
                    html = '<img height="20" width="20" src="' + resp + '" />';
                    //$("#upload-demo-i").html(html);
                    $(lab).html(html);
                }
            });
        });
    });

    //NOTE for you: Rotate
    $("#rotateLeft").click(function() {
        $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
    });
    //NOTE for you: Rotate
    $("#rotateRight").click(function() {
        $uploadCrop.croppie('rotate', parseInt($(this).data('deg')));
    });
    $("#exit").click(function() {
        var div = document.getElementById('wizardDiv');
        div.style.display = 'none';
        //location.reload();
    });
</script>

</html>