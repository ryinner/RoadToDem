<h2>Управление категориями</h2>
<hr>
<!-- Управление категориями старт  -->
<div class="row">
    <div class="form-container">
        <input type="text" name="name" placeholder="Введите категорию">
        <button id="create">Создать категорию</button>
    </div>
    <div class="form-container">
        <select name="category" id="category"></select>
        <button id="delete">Удалить категорию</button>
    </div>
</div>
<!-- Управление категориями конец  -->
<hr>
<!-- Управление заявками старт  -->
<h2>Управление Заявками</h2>
<hr>
<?php 
    $orders = new MasterOk\Controllers\OrdersController;
    $orders->get();
?>
<!-- Управление заявками конец  -->
<div class="modal working off">
    <input type="number" name="newPrice" min="1" value="1">
    <button id="workingGo">Отправить</button> 
</div>
<div class="modal ready off">
    <form id="form">
        <input type="file" name="img">
        <button id="readyGo">Отправить</button> 
    </form>
</div>
<script src="/src/front/js/category/formCategoryGet.js"></script>
<script src="/src/front/js/category/formCategoryAdd.js"></script>
<script src="/src/front/js/category/formCategoryDelete.js"></script>
<script src="/src/front/js/orders/formChangeStatusOrders.js"></script>