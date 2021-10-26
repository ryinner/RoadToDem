$('#working').on('click', function () {
    $('.ready').addClass('off');
    $('.working').removeClass('off');

    let id = $(this).val();
    let status = 'Ремонтируется'
    $('#workingGo').on('click',function () {
        let newPrice = $('input[name=newPrice]').val();
        $.ajax({
            type: "post",
            url: "/orders.php",
            data: {id:id, status:status, newPrice:newPrice ,action:"update"},
            success: function (data) {
                console.log(data);
                // document.location.href = 'http://localhost/master.php';
            }
        });
    })
});

$('#ready').on('click', function (event) {
    event.preventDefault();

    $('.working').addClass('off');
    $('.ready').removeClass('off');

    let id = $(this).val();
    let status = 'Отремонтировано';

    $('#readyGo').on('click', function(event) {
        event.preventDefault();
        let img = $('input[name=img]');

        let form = document.querySelector("#form");
        let formData = new FormData(form);
        
        formData.append('id',id);
        formData.append('status',status);
        formData.append('action','update');
        if (img.prop('files').length == 0) {
            img.addClass('invalid');
            toast = new Toast('imgValid','Добавьте фотографию','error');
            toast.show();
            toast.hide();
            validate = false;
        } else {
            $.ajax({
                type: "post",
                url: "/orders.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if (data.success == "error") {
                        img.addClass('invalid');
                        let toast = new Toast('serverRegistration',data.message,data.success);
                        toast.show();
                        toast.hide();
                    } else {
                        document.location.href = 'http://localhost/master.php';
                    }
                }
            });
        }
       
    })
    
});