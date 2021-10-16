$('#loginButton').on('click',function(){
    // vars
    let valide = true;
    let toast;
    let validator;
    let validValue;
    // Inputs
    let login    = $('.input[name=login__login]')
    let password = $('.input[name=pass__login]'); 
    // Валидаторы для логина и пароля

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

    validator = new Validator(password,password.val());

    if (validator.isEmpty() == true) {
        let toast = new Toast('notAllInputValid','Заполните пароль','error');
        toast.show();
        toast.hide();
        valide = false;
    }


     // Проверка всех булевых значений, если все хорошо Ajax запускается

     if (valide == true) {
        $.ajax({
            url: '/login.php',
            method: 'post',
            data: {login:login.val(),password:password.val()},
            success: success
        });
    }

    // Вывод с сервера, если сервер возвращает error, то выходит сообщение об ошибке, иначе об успехе регистрации

    function success(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data.success == "true") {
            document.location.href = 'http://masterok';
        } else {
            login.addClass('invalid');
            password.addClass('invalid');
            toast = new Toast('serverRegistration','Неправильный логин или пароль',data.success);
            toast.show();
            toast.hide();
        }
       
    }
});