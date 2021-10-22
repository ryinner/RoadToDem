$('.filters').on('click', function(event) {
    event.preventDefault();
    
    filter = $(this).attr('value');
    getOrders(filter);
});