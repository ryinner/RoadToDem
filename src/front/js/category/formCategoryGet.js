// Ajax на получение категорий
function categoryGet() {
    $.ajax({
        type: "post",
        url: "/category.php",
        data: {action:"get"},
        success: function (data) {
            $('#category').empty();
            data = JSON.parse(data);
            for (i=0;i<data.length;i++) {
                $('#category').append('<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>');
            }
        }
    });
}
// Первоначальная отрисовка
categoryGet();
// Обновление геттера раз в 5 секунд
setInterval(categoryGet,5000);