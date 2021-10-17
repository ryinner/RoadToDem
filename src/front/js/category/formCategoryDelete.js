$('#delete').on('click',function(){
    // Получение данных и отправка ajax на удаление
    let id = $('#category').val();
    $.ajax({
        type: "post",
        url: "/category.php",
        data: {id:id,action:"delete"},
        success: function () {
            // Вывод сообщения об успехе
            let toast = new Toast('deleteCategory','Вы удалили категорию','success');
            toast.show();
            toast.hide();
        }
    });
});