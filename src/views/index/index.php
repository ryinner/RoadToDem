<h1>Последние заявки</h1>

<!--  Счетчик старт  -->
<h2>Всего выполненных работ:<span id="count"></span></h2>
<!--  Счетчик конец  -->

<hr>

<!--  Блок форм регистрации и авторизации старт  -->
<h3>Создай аккаунт прямо сейчас</h3>
<div class="row">
    <div id="registration">
        <div class="form-container">
            <input type="text" class="input" name="name" placeholder="Введите ФИО" required>
            <input type="text" class="input" name="login" placeholder="Введите логин" required>
            <input type="email" class="input" name="email" placeholder="Введите почту" required>
            <input type="password" class="input" name="pass" placeholder="Введите пароль" required>
            <input type="password" class="input" name="repass" placeholder="Повторите пароль" required>
            <input type="checkbox" class="input" name="check" required><label for="check">Подтвердите согласие на обработку</label>
            <button id="registrationButton">Зарегистрироваться</button>
        </div>
    </div>
    <div id="login">
        <div class="form-container">
            <input type="text" name="login__login" class="input" placeholder="Введите логин" required>
            <input type="password" name="pass__login" class="input" placeholder="Введите пароль" required>
            <button id="loginButton">Авторизироваться</button>
        </div>
    </div>
</div>
<script src="/src/front/js/formRegistration.js"></script>
<script src="/src/front/js/formLogin.js"></script>
<!--  Блок форм регистрации и авторизации конец  -->