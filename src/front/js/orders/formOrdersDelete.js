// Удаление заявки
$(document).on('click','.delete',function(event) {
    event.stopPropagation()
    // Получение данных и отправка ajax на удаление
    let id = $(this).val();
    // Вызов модального окна
    $('.modal').removeClass('off');

    // Отказ от удаления
    $('#no').on('click',function() {
        $('.modal').addClass('off');
    })
    
    // Согласие
    $('#yes').on('click',function() {
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
        $('.modal').addClass('off');
    })
  
});
