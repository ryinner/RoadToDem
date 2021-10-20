function getOrders () {
    $.ajax({
        type: "POST",
        url: "/orders.php",
        data: {action:'getForUser'},
        success: function (data) {
            console.log(data);
        }
    });
}

setInterval(getOrders,5000);