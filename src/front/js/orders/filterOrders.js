// Получение значения фильтра
$('.filters').on('click', function(event) {
    event.preventDefault();
    
    filter = $(this).attr('value');
    getOrders(filter);
});