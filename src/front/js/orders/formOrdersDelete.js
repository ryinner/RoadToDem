$(document).on('click','.delete',function() {
    console.log('hi');
    // Получение данных и отправка ajax на удаление
    let id = $(this).val();
    console.log(id);
    $.ajax({
        type: "post",
        url: "/orders.php",
        data: {id:id,action:"delete"},
        success: function () {
            // Вывод сообщения об успехе
            let toast = new Toast('deleteOrders','Вы удалили свою заявку','success');
            toast.show();
            toast.hide();
        }
    });
    $('#'+id).hide();
});
