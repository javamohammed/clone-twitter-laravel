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