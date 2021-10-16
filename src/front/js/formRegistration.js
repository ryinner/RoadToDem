$('#registrationButton').on('click',function (event){
    
    // Обновление классов

    $('.form-container input').removeClass('invalid')

    // Создание переменных для успеха валидации и Toast-messages

    let valide = true;
    let toast;
    let validator;
    let validValue;
    // Inputs

    let name       = $('.input[name=name]');
    let login      = $('.input[name=login]');
    let email      = $('.input[name=email]');
    let password   = $('.input[name=pass]');
    let repassword = $('.input[name=repass]');
    let check      = $('.input[name=check]');

    // Вся валидация на условиях, если не соблюдается, то функция возврщает false, если проходят все то true

    validValue  = /^[А-ЯЁ\s-]+$/i;
    validator = new Validator(name,name.val(),validValue);

    if (validator.isEmpty() == true) {
        let toast = new Toast('notAllInputValid','Заполните ФИО','error');
        toast.show();
        toast.hide();
        valide = false;
    } else {

        if (validator.validate() == false) {
            toast = new Toast('nameValid','Введите только руссие буквы, пробелы, дефисы в ФИО','error');
            toast.show();
            toast.hide();
            valide = false;
        }

    }

    validValue = /[A-Z.]/i;
    validator = new Validator(login,login.val(),validValue);

    if (validator.isEmpty() == true ) {
        let toast = new Toast('notAllInputValid','Заполните логин','error');
        toast.show();
        toast.hide();
        valide = false;
    } else {

        if (validator.validate() == false) {
            toast = new Toast('loginValid','Введите только английские буквы и точки в логине','error');
            toast.show();
            toast.hide();
            valide = false;
        }

    }

    validValue = /\S+@\S+\.\S+/i;
    validator = new Validator(email, email.val(),validValue);

    if (validator.isEmpty() == true ) {
        let toast = new Toast('notAllInputValid','Заполните почту','error');
        toast.show();
        toast.hide();
        valide = false;
    } else {

        if (validator.validate() == false) {
            toast = new Toast('emailValid','Неверный тип почты','error');
            toast.show();
            toast.hide();
            valide = false;
        }

    }

    validator = new Validator(password,password.val());

    if (validator.isEmpty() == true) {
        let toast = new Toast('notAllInputValid','Заполните пароль','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    validator = new Validator(repassword,repassword.val()) 

    if (validator.isEmpty() == true) {
        let toast = new Toast('notAllInputValid','Повторите пароль','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    if (check.prop('checked') == false) {
        check.addClass('invalid');
        let toast = new Toast('notAllInputValid','Согласие обязательно','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    if (password.val() !== repassword.val()) {
        toast = new Toast('passwordValid','Пароли не совпадают','error');
        toast.show();
        toast.hide();
        repassword.addClass('invalid');
        valide = false;
    }

    // Проверка всех булевых значений, если все хорошо Ajax запускается

    if (valide == true) {
        $.ajax({
            url: '/registration.php',
            method: 'post',
            data: {name:name.val(),login:login.val(),email:email.val(),password:password.val()},
            success: success
        });
    }

    // Вывод с сервера, если сервер возвращает error, то выходит сообщение об ошибке, иначе об успехе регистрации

    function success(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data.success == "error") {
            login.addClass('invalid');
        }
        toast = new Toast('serverRegistration',data.message,data.success);
        toast.show();
        toast.hide();
    }

});