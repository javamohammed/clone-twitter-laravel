$( ".like" ).click(function() {
  
  let  tweet_id = $(this).attr("id")
  let countLike =  parseInt($(".count-like-"+tweet_id).text());  
  $.ajax({
      type: "GET",
      url: 'http://localhost/clone-twitter-laravel/public/like/'+tweet_id,
      dataType: 'json',
      success: function(data){
         let img = $('#'+tweet_id).attr("src");
        if( img == 'images/icons_0/like_red.svg'){
          countLike = countLike - 1 
          $('#'+tweet_id).attr("src","images/icons_0/like.svg");
        }else{
          countLike = countLike + 1 
          $('#'+tweet_id).attr("src","images/icons_0/like_red.svg");
        }
        $(".count-like-"+tweet_id).text(countLike)
        
      }
  });
  });


  $(".count-comment-class").click(function() {
    console.log(window.location.href)
    let  tt = $(this).attr("id");
    let tweet_idArray = tt.split('-')
    let tweet_id = tweet_idArray[2];
    const oldAction = $("#form-comment").attr("action")
    const regex = /(\/comment\/.*)/gi;
    const p = oldAction.replace(regex, '/comment/'+tweet_id+'/'+tweet_idArray[1])
    console.log("p  ",p)
   $("#form-comment").attr("action", p)
  })


  $( ".delete" ).click(function() {
  
    let  bookmark_id = $(this).attr("id")
    console.log(bookmark_id)
    $.ajax({
        type: "DELETE",
        url: 'http://localhost/clone-twitter-laravel/public/bookmark/delete',
        dataType: 'json',
        data:{
          id: bookmark_id,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        success: function(data){
          location.reload();
        }
    });
});

$( ".delete-from-list" ).click(function() {
  
  let  userId = $(this).attr("id")
  let  listId = $(this).attr("list")
  
  $.ajax({
      type: "POST",
      url: 'http://localhost/clone-twitter-laravel/public/lists/delete/user',
      dataType: 'json',
      data:{
        listId: listId,
        userId:userId
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      success: function(data){
        console.log(data)
        location.reload();
      }
  });
});
  

$( ".suggestion" ).click(function() {

  const  element = $(this).attr("id")
  const arrElement = element.split('|')
  const id_follow =  arrElement[0]
  const user_id =  arrElement[1]
  $( "#"+id_follow+'-container' ).remove();
  $.ajax({
    type: "GET",
    url: 'http://localhost/clone-twitter-laravel/public/subscribe/'+user_id+'/'+id_follow,
    dataType: 'json',
    success: function(data){
      
    }
});
  });

$('#more-subscribers').click(function () {
  location.reload();
})

$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});


$( "#new_member" ).keyup(function(event) {

  const  str = event.target.value
  $('#livesearch').empty()
  $( "#livesearch" ).hide();

  $.ajax({
    type: "GET",
    url: "http://localhost/clone-twitter-laravel/public/users/load/"+str,
    dataType: 'json',
    success: function(data){
      $.each(data, function(k, v) {
        $('#livesearch').append($('<option>', {
          value:k,
          text: v
      }));
    });
    $( "#livesearch" ).show();
      }
  });
  });