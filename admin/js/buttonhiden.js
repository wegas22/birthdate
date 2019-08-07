window.onload = function() {
    document.getElementById("box").addEventListener("click",
        function(e) {
            e = e || window.event;
            var target = e.target || e.srcElement;
            if (target.id == "btn") {
                var div = document.getElementById('btnclick');
                //div.style.display = 'block';
                if (div.style.display != "block") {
                    div.style.display = "block"; //Показываем элемент
                } else div.style.display = "none"; //Скрываем элемент
            }
        }
    );
};