<h1>Последние заявки</h1>

<!--  Счетчик старт  -->
<h2>Всего выполненных работ: <span id="count"></span></h2>
<!--  Счетчик конец  -->

<hr>

<!--  Заявки старт  -->
<h3>Наши выполненные заявки</h3>
<div class="row">
    <?php
        $orders = new MasterOk\Controllers\OrdersController;;
        $orders->index();
    ?>
</div>
<!--  Заявки конец  -->
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
<div id="ads">
    <hr>
    <h3>Сделай свою семью счастливой уже сейчас</h3>
    <div class="row">
        <img src="src/front/img/Семья.jpg" width='400px' style="margin:4px;">
    </div>
</div>
<script src="/src/front/js/indexForms/formRegistration.js"></script>
<script src="/src/front/js/indexForms/formLogin.js"></script>
<script src="/src/front/js/orders/counter.js"></script>
<script src="/src/front/js/animation/img.js"></script>
<!--  Блок форм регистрации и авторизации конец  -->