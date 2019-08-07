    $('#wizardDiv').draggable({
        handle: 'ul'
    });
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: false,
        viewport: {
            width: 225,
            height: 225,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
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