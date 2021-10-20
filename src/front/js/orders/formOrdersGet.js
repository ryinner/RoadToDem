function getOrders () {
    $.ajax({
        type: "POST",
        url: "/orders.php",
        data: {action:'getForUser'},
        success: function (data) {
            $('#orders').empty();
            data = JSON.parse(data);
            console.log(data);
            for(i=0;i<data.length;i++) {
                console.log(data[i]);
                if (data[i].end_price == null) {
                    data[i].end_price = 'не согласована';
                }
                $('#orders').append(
                    '<div class="order"><h3>Дата: '+data[i].data+'</h3><p class="text__center">Адрес: '+ data[i].adress +'</p><p class="text__center">Описание: '+ data[i].description +'</p><p class="text__center">Статус: '+ data[i].status +'</p><p class="text__center">Цена: '+ data[i].end_price +'</p></div>'
                );
            }
        }
    });
}

getOrders();

setInterval(getOrders,5000);