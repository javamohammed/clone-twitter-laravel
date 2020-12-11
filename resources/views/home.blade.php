@include('layouts.header', ['file' => 'home'])

    <div class="container">
      <div class="profile-fixed"> 
        <img src="./images/avatar-home.png"  class="float-left rounded-circle profile-home" alt="profile Home">
        <p  style="font-size: 14px; padding-top: 10px;">
          <strong>Mohammed Aoulad Bouchta</strong><img src="./images/icons_profile/flesh-bottom.svg"><br>
          <span style="color: gray;">@AouladBouchta</span>
        </p>
      </div>
        <div class="row">
          @include('layouts.left-menu')
          <div class="col-sm-6 border centered-div">
            <div class="row justify-content-md-center border border-top-0 mt-2">
                <div class="col-sm float-left ">
                    <h5><strong>Acceuil</strong></h5> 
                  </div>
                  <div class="col-sm float-right"> 
                    <img src="images/icons/icon_home.png" class="float-right icon-home"  />
                  </div>
            </div>
            <div class="row justify-content-md-center  border-top-0 pl-0 box-post"> 
                <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
               
                    <img src="./images/avatar-home.png"  class="rounded-circle profile-home" alt="profile Home">
                </div>
                <form method="POST" action="{{route('save.tweet')}}">
                  @csrf
                  <div class="what-is-news"> <div class="content-post-div">
    
                    <textarea name="tweet_text" id="content-post-textarea" style="border: none ;     background-color: transparent;     resize: none;     outline: none;" cols='55' rows="3" placeholder="Quoi de neuf?"></textarea></div>
                      @error('tweet_text')
                          <div class="alert alert-danger">Please, say something :)</div>
                      @enderror
                    <br>
                      <img src="images/icons/images.svg" class="ml-1 mr-1 home-icons"  />
                      <img src="images/icons/gif.svg" class="ml-1 mr-1 home-icons"  />
                      <img src="images/icons/quotion.svg" class="ml-1 mr-1 home-icons"  />
                      <img src="images/icons/emo.svg" class="ml-1 mr-1 home-icons"  />
                      <img src="images/icons/calandar.svg" class="ml-1 mr-1 home-icons"  />
                      <button type="submit" class="btn btn-primary float-right disabled mr-1 mb-1 " >Tweeter</button>
                  </div>

                </form>
              </div>

              @foreach ($tweets as $tweet)
                  
                <div class="row justify-content-md-center border border-top-0">
                  <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                    <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                  
                        <img src="./images/avatar-home.png"  class="rounded-circle profile-home" alt="profile Home">
                    </div>
                  <div class="post"><a href="{{route('get_user', ['userId' => $tweet->user_id])}}" class="name-user-profile">{{$tweet->user->name}}</a> <a href="{{route('get_user', ['userId' => $tweet->user_id])}}" class="username">{{"@".$tweet->user_id}}</a> -
                     <span><a class="time-post" href="{{route('show_comments',['tweet_id' => $tweet->id, 'back' => 'home'])}}">{{$tweet->createdAt()}}</a></span> 
                     @if ($tweet->tweet_owner != null)
                        <span class="time-post" >Retweet from </span>
                        <a href="{{route('get_user', ['userId' => $tweet->getRetweetUserId()])}}" class="name-user-profile">{{$tweet->getRetweetUserName()}}</a>
                     @endif
                     <br>
                      <p class="post-content">
                        {{$tweet->tweet_text}}<br>
                        @foreach ($tweet->hashtags as $hashtag)
                          @php
                              $hash = str_replace('#', '',$hashtag->hashtag );
                          @endphp
                          <a href="{{route('hashtag.index', ['hashtag' => $hash])}}">{{$hashtag->hashtag}}</a><br>
                        @endforeach
                        
                      </p>
                      <a  class="count-comment-class" href="#" data-toggle="modal" data-target="#exampleModal" id="comment-home-{{$tweet->id}}" >
                          <img src="images/icons_0/comment.svg" class="ml-1 mr-1 post-icons "  /></a><span>{{$tweet->comments->count()}}</span> 
                 
                        @php
                          $isRed = 0;
                        @endphp
                        @foreach ($tweet->likes as $like)
                            @if ($like->user_id == Auth::id())
                              @php
                                  $isRed = 1;
                              @endphp
                              @break
                            @endif
                            
                        @endforeach

                        @if ($isRed == 0)
                          <img src="images/icons_0/like.svg" class="ml-1 mr-1 post-icons like"   id={{$tweet->id}} /><span class="count-like-{{$tweet->id}}" >{{$tweet->likes->count()}}</span>        
                        @else
                          <img src="images/icons_0/like_red.svg" class="ml-1 mr-1 post-icons like"   id={{$tweet->id}} /><span class="count-like-{{$tweet->id}}" >{{$tweet->likes->count()}}</span>
                        @endif

                        
                        <a href="{{route('retweet.tweet', ['id' => $tweet->id])}}"><img src="images/icons_0/share.svg" class="ml-1 mr-1 post-icons"  /></a>
                        <a href="{{route('bookmark.save', ['tweet_id' => $tweet->id])}}"><img src="images/icons_0/register.svg" class="ml-1 mr-1 post-icons "  /></a>
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
                      <img src="./images/avatar-home.png"  class="rounded-circle profile-home" alt="profile Home">
                    </div>
                    In the example above, Eloquent will try to match the..
                    
                    <br><br>
                   <p style="margin-left: 30px">
                      En réponse à <a href="#">@alaraby_ar</a>
                   </p>
                  </div>
                  <div>

                  <form method="POST" id="form-comment" action="{{route('save.comment', ['tweet_id' => '0', 'redirect_to' => 'home'])}}">
                    @csrf
                    <div class="what-is-news">
                      <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                        <img src="./images/avatar-home.png"  class="rounded-circle profile-home" alt="profile Home">
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
