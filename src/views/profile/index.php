<h2>Привет, <?php echo $_SESSION['login']; ?></h2>
<hr>
<h3>Оставить заявку на ремонт можно ниже</h3>
<!--  Блок формы заявки старт  -->
<div class="row">
    <form id="formOrderAdd" class="form-container">
        <input type="text" name="adress" placeholder="Введите адрес помещения">
        <textarea name="description" placeholder="Описание" cols="30" rows="3"></textarea>
        <select name="category" id="category"></select>
        <input type="number" name="maxPrice" min="0" placeholder="Максимальная цена ">
        <input type="file" name="img">
        <button id="create">Добавить заявку</button>
    </form>
</div>
<!--  Блок формы заявки конец  -->
<hr>
<h3>Вот и все наши с вами работы</h3>
<!-- Фильтр начало -->
<div class="row" style="margin: 6px 0;">
    <a href="javascript;;" class="filters" value="">Все</a>
    <a href="javascript;;" class="filters" value="Новая">Новые</a>
    <a href="javascript;;" class="filters" value="Ремонтируется">Ремонтирующиеся</a>
    <a href="javascript;;" class="filters" value="Отремонтировано">Отремонтированые</a>
</div>
<!-- Фильтр конец -->
<!-- Заявки начало -->
<div class="row" id="orders">

</div>
<!-- Заявки конец -->
<div class="modal off">
    <div class="modal__window">
        <button id="yes">Удалить</button>
        <button id="no">Не удалять</button>
    </div>
</div>
<script src="/src/front/js/orders/formOrdersGetForUser.js"></script>
<script src="/src/front/js/category/formCategoryGet.js"></script>
<script src="/src/front/js/orders/formOrdersAdd.js"></script>
<script src="/src/front/js/orders/formOrdersDelete.js"></script>
<script src="/src/front/js/orders/filterOrders.js"></script>
