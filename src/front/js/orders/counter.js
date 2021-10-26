function counter () {
    $.ajax({
        type: "post",
        url: "/orders.php",
        data: {action:"count"},
        success: function (data) {
            $('#count').empty();
            data = JSON.parse(data);
            console.log(data);
            $('#count').append(data.count);
        }
    });
}

counter();

setInterval(counter,4000);