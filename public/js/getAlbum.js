function getAlbum(){
    var album = document.getElementById("album").value;
    if(album.length >=1 ){
        document.getElementById('album_search').style.display = 'block';
    }else{
        document.getElementById('album_search').style.display = 'none';
    }
    $.ajax({
        type: 'post',
        url: "/getalbumajax", //Путь к обработчику
        cache: false,
        timeout:3000,
        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },
        data: {album, album},

        success: function(data){
            $("#album_search").html(data).fadeIn();
       },
       beforeSend: function(data) {

            $('#results').html('<p>Ожидание данных...</p>');

        },
        dataType:"html",
         // Функция сработает в случае ошибки
        error:  function(data){
            $('#results').html('<p>Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...</p>');
            }
    });


}
$("#album_search").hover(function(){
    $(".who").blur(); //Убираем фокус с input
})

$(function(){
    $("#album_search").on("click", "li", function(){
        s_user = $(this).text();
        document.getElementById('album').value = s_user;
        document.getElementById('album_search').style.display = 'none';
})

})

function album_click(clicked_id)
  {
      document.getElementById('album_id').value = clicked_id;
  }