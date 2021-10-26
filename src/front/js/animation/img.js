$('.up').on('mouseover',function() {
    let id = $(this).attr('id');
    $('#'+id).addClass('off');
    $('#'+id+'admin').removeClass('off');
})

$('.up').on('mouseout',function() {
    let id = $(this).attr('id');
    $('#'+id+'admin').addClass('off');
    $('#'+id).removeClass('off');
})