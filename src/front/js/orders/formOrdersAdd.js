// Добавление заявки
$('#create').on('click',function(event) {
    event.preventDefault();

    $('.form-container input').removeClass('invalid');
    $('.form-container textarea').removeClass('invalid');
    // Рабочие переменные
    let validate = true;
    let toast;
    let validator;

    // inputs
    let adress = $('input[name=adress]');
    let descrption = $('textarea[name=description]');
    let maxPrice = $('input[name=maxPrice]');
    let img = $('input[name=img]');

    // Валидация
    validator = new Validator(adress,adress.val());
    if (validator.isEmpty() == true) {
        toast = new Toast('adressValid','Заполните адрес','error');
        toast.show();
        toast.hide();
        validate = false;
    }

    validator = new Validator(descrption,descrption.val());
    if (validator.isEmpty() == true) {
        toast = new Toast('descrptionValid','Заполните описание','error');
        toast.show();
        toast.hide();
       
        validate = false;
    }
    validator = new Validator(maxPrice,maxPrice.val());
    if (validator.isEmpty() == true) {
        toast = new Toast('maxPriceValid','Заполните цену','error');
        toast.show();
        toast.hide();
        validate = false;
    }
    
    if (img.prop('files').length == 0) {
        img.addClass('invalid');
        toast = new Toast('imgValid','Добавьте фотографию','error');
        toast.show();
        toast.hide();
        validate = false;
    }

    // Валидация пройдена, тогда ajax, с выводом сообщения
    if (validate == true) {
        let form = document.querySelector("#formOrderAdd");
        let formData = new FormData(form);
        formData.append('action','add');
        $.ajax({
            type: "post",
            url: "/orders.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success == "error") {
                    img.addClass('invalid');
                }
                toast = new Toast('serverRegistration',data.message,data.success);
                toast.show();
                toast.hide();
                getOrders();
            }
        });
    }
});