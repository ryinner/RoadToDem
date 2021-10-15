let success = new Toast('valid','Вы зарегистрировались','success');

$('#reg').on('click',function (event){
    
    // Обновление классов

    $('.form-container input').removeClass('invalid')

    // Создание переменных для успеха валидации и Toast-messages

    let valide = true;
    let toast;

    // Inputs

    let name = $('.input[name=name]');
    let login = $('.input[name=login]');
    let email = $('.input[name=email]');
    let password = $('.input[name=pass]');
    let repassword = $('.input[name=repass]');
    let check = $('.input[name=check]');

    // Вся валидация на условиях, если не соблюдается, то функция возврщает false, если проходят все то true

    if (name.val() === '' || login.val() === '' || email.val() === '' || password.val() === '' || repassword.val() === '' || check.prop('checked') == false) {
        $('#registration .form-container input').addClass('invalid');
        let toast = new Toast('notAllInputValid','Заполните поля','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    let validValue  = /^[А-ЯЁ\s-]+$/i;
    let validator = new Validator(validValue,name.val(),name);

    if (validator.validate() == false) {
        toast = new Toast('nameValid','Введите только руссие буквы, пробелы, дефисы','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    validValue = /[A-Z.]/i;
    validator = new Validator(validValue,login.val(),login);
    if (validator.validate() == false) {
        toast = new Toast('loginValid','Введите только английские буквы и точки','error');
        toast.show();
        toast.hide();
        valide = false;
    }

    validValue = /\S+@\S+\.\S+/i;
    validator = new Validator(validValue, email.val(),email);
    if (validator.validate() == false) {
        toast = new Toast('emailValid','Введите почту','error');
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
    
    // Проверка всех булевых значений, если все хорошо AjaxWork

    if (valide == true) {
        $.ajax({
            url: '/registration.php',
            method: 'post',
            data: {name:name.val(),login:login.val(),email:email.val(),password:password.val()},
            success: success
        });
    }

    // Вывод с сервера

    function success(data) {
        console.log(data);
    }

});