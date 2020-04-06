function getArtist(){
    var artist = document.getElementById("artist").value;
    if(artist.length >=1 ){
        document.getElementById('artist_search').style.display = 'block';
    }else{
        document.getElementById('artist_search').style.display = 'none';
    }
    $.ajax({
        type: 'post',
        url: "/getartistajax", //Путь к обработчику
        cache: false,
        timeout:3000,
        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },
        data: {artist:artist},

        success: function(data){
            $("#artist_search").html(data).fadeIn();
       },
       beforeSend: function(data) {
            $("#artist_search").html('<p>Очікування даних</p>');

        },
        dataType:"html",
         // Функция сработает в случае ошибки
        error:  function(data){
            $('#results').html('<p>Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...</p>');
            }
    });


}
$("#artist_search").hover(function(){
    $(".who").blur(); //Убираем фокус с input
})

$(function(){
    $("#artist_search").on("click", "li", function(){
        s_user = $(this).text();
        document.getElementById('artist').value = s_user;
        document.getElementById('artist_search').style.display = 'none';
})

})





