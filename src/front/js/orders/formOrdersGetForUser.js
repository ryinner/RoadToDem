var filter;
function getOrders () {
    $.ajax({
        type: "POST",
        url: "/orders.php",
        data: {action:'getForUser', filter:filter},
        success: function (data) {
            $('#orders').empty();
            console.log(data);
            data = JSON.parse(data);
            for(i=0;i<data.length;i++) {
                console.log(data[i]);
                if (data[i].end_price == null) {
                    data[i].end_price = 'не согласована';
                }
                $('#orders').append(
                    '<div class="order" id="'+data[i].id+'"><h3>Дата: '+data[i].data+'</h3><p class="text__center">Адрес: '+ data[i].adress +'</p><p class="text__center">Описание: '+ data[i].description +'</p><p class="text__center">Статус: '+ data[i].status +'</p><p class="text__center">Цена: '+ data[i].end_price +'</p></div>'
                );
                if (data[i].status == 'Новая') {
                    $('#'+data[i].id).append(
                        '<button class="delete" value="'+data[i].id+'">Удалить</button>'
                    );
                }
            }
        }
    });
}

getOrders();