$('#create').on('click',function(){
    // Сброс класса
    $('.form-container input').removeClass('invalid');
    // input
    let name = $('input[name=name]');
    // Переменные
    let validate = true;
    let toast;
    let validator;
    // Валидация
    validator = new Validator(name,name.val());
    if (validator.isEmpty() == true) {
        toast = new Toast('nameValid','Заполните название категории','error');
        toast.show();
        toast.hide();
        validate = false;
    }
    // Если валидация пройдена
    if (validate == true) {
        $.ajax({
            type: "POST",
            url: "/category.php",
            data: {name:name.val(),action:'add'},
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);

                if (data.success == "error") {
                    name.addClass('invalid');
                }

                toast = new Toast('serverAdd',data.message,data.success);
                toast.show();
                toast.hide();
            }
        });
    }
});