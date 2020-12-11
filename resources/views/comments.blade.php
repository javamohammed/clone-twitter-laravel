@include('layouts.header', ['file' => 'home'])
    <div class="container">
      <div class="profile-fixed"> 
        <img src="{{asset('./images/avatar-home.png')}}"  class="float-left rounded-circle profile-home" alt="profile Home">
        <p  style="font-size: 14px; padding-top: 10px;">
          <strong>Mohammed Aoulad Bouchta</strong><img src="{{asset('./images/icons_profile/flesh-bottom.svg')}}"><br>
          <span style="color: gray;">@AouladBouchta</span>
        </p>
      </div>
        <div class="row">
          @include('layouts.left-menu')
          <div class="col-sm-6 border centered-div">
            <div class="row justify-content-md-center border border-top-0 mt-2">
                <div class="col-sm float-left ">
                  <a href="{{route('back', ['page' => $back])}}"><img src="{{asset('images/icons_profile/back.svg')}}" class="icon-back"  /></a>
                  <h5><strong>Discussion</strong></h5> 
                  </div>
                  <div class="col-sm float-right"> 
                    <img src="{{asset('images/icons/icon_home.png')}}" class="float-right icon-home"  />
                    
                  </div>
            </div>
            <div class="row justify-content-md-center  border-top-0 pl-0 box-post"> 

              <div class="row justify-content-md-center border border-top-0">
                <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                
                  <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                </div>
                <div class="post"><a href="{{route('profile')}}" class="name-user-profile">{{$tweet->user->name}}</a> <a href="{{route('profile')}}" class="username">{{"@".$tweet->user_id}}</a> -
                 <span><a class="time-post" href="{{route('show_comments',['tweet_id' => $tweet->id, 'back' => $back])}}">{{Carbon\Carbon::parse($tweet->created_at)->diffForHumans()}}</a></span> <br>
                  <p class="post-content">
                  {{$tweet->tweet_text}}
                  </p>
                  <a  class="count-comment-class" href="#" data-toggle="modal" data-target="#exampleModal" id="comment-cmt-{{$tweet->id}}" >
                    <img src="{{asset('images/icons_0/comment.svg')}}" class="ml-1 mr-1 post-icons "  /></a><span>{{$tweet->comments->count()}}</span> 
                </div>
                </div>
              </div>


                
              </div>

              @foreach ($comments as $comment)
                <div class="row justify-content-md-center border border-top-0">
                  <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                    <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                  
                        <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                    </div>
                  <div class="post">
                    <a href="{{route('get_user', ['userId' => $comment->user_id])}}" class="name-user-profile">{{$comment->user->name}}</a>
                     <a href="{{route('get_user', ['userId' => $comment->user_id])}}" class="username">{{"@".$comment->user_id}}</a> -
                     <span><a class="time-post" href="#">{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</a></span> <br>
                      <p class="post-content">
                        {{$comment->comment_text}}
                      </p>
                    </div>
                  </div>
                </div>
              @endforeach

          </div>
          @include('layouts.right-menu')
        </div>



         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div>
                    <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                      <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                    </div>
                    In the example above, Eloquent will try to match the..
                    
                    <br><br>
                   <p style="margin-left: 30px">
                      En réponse à <a href="#">@alaraby_ar</a>
                   </p>
                  </div>
                  <div>

                  <form method="POST" id="form-comment" action="{{route('save.comment', ['tweet_id' => '0', 'redirect_to' => 'cmt'])}}">
                    @csrf
                    <div class="what-is-news">
                      <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                        <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                      </div>
                      <textarea name="comment_text" class="content-post-textarea" style="border: none ;     background-color: transparent;     resize: none;     outline: none;" cols='55' rows="3" placeholder="Tweetez votre réponse."></textarea><br>
                    </div>
                    <button type="submit" class="btn btn-primary float-right disabled mr-1 mb-1 " >Répondre</button>
                  </form>

                  </div>

                </div>
            </div>
          </div>
        </div>
      </div>

 
@include('layouts.footer', ['file' => 'home'])
