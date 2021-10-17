<h2>Привет, <?php echo $_SESSION['login']; ?></h2>
<hr>
<h3>Оставить заявку на ремонт можно ниже</h3>
<!--  Блок формы заявки старт  -->
<div class="row">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <input type="text" name="adress" placeholder="Введите адрес помещения">
            <textarea name="description" placeholder="Описание" cols="30" rows="3"></textarea>
            <select name="category" id="category"></select>
            <input type="number" name="maxPrice" min="0" placeholder="Максимальная цена ">
            <input type="file">
            <button>Добавить заявку</button>
        </div>
    </form>
</div>
<!--  Блок формы заявки конец  -->
<hr>
<h3>Вот и все наши с вами работы</h3>

<script src="/src/front/js/category/formCategoryGet.js"></script>