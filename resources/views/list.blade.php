@include('layouts.header', ['file' => 'home'])

    <div class="container">
      <div class="profile-fixed"> 
        <img src="{{asset('images/avatar-home.png')}}"  class="float-left rounded-circle profile-home" alt="profile Home">
        <p  style="font-size: 14px; padding-top: 10px;">
          <strong>Mohammed Aoulad Bouchta</strong><img src="{{asset('images/icons_profile/flesh-bottom.svg')}}"><br>
          <span style="color: gray;">@AouladBouchta</span>
        </p>
      </div>
        <div class="row">
          @include('layouts.left-menu')
          <div class="col-sm-6 border centered-div">
            <div class="row justify-content-md-center border border-top-0 mt-2">
                <div class="col-sm float-left ">
                  <a href="{{route('home')}}"><img src="{{asset('images/icons_profile/back.svg')}}" class="icon-back"  /></a>
                    <h5><strong>Lists</strong></h5> 
                  </div>
                  <div class="col-sm float-right"> 
                    
                    
                  </div>
            </div>
            <div class="lists">
              {{$list->name_group}}
             </div>

             <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="members-tab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="true">Members</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Tweets-tab" data-toggle="tab" href="#Tweets" role="tab" aria-controls="Tweets" aria-selected="false">Tweets</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="members" role="tabpanel" aria-labelledby="members-tab">
                <div class="row justify-content-md-center border border-top-0 style-list" style="padding-top: 8px;">
                  <div class="row justify-content-md-center  border-top-0 pl-0 " style="text-align:center;"> 
                    <div class="list-header">
                          <img src="https://pbs.twimg.com/media/EXZ2w_qUcAMwN3x?format=png&name=small" class="img-header-list" />
                    </div>
                    <div style="text-align:center;">
                        <h3  >{{$list->name_group}}</h3>
                      <h6 >{{$list->user->name}}</h6>
                      <h6 >{{$list->users->count()}} Members</h6>
                      <a href="#" data-toggle="modal" data-target="#exampleModal" id="add_list">
                          <img src="{{asset('images/icons/lists.svg')}}" style="padding-right:5px; cursor: pointer; " class="icon-home"  />
                      </a>
                    </div>
                    <div class="members">
                      <div class="post">
                        @foreach ($list->users as $user)
                          <a href="{{route('get_user', ['userId' => $user->id])}}" class="username">{{'@'.$user->id}} {{$user->name}}</a>
                          @if (\Auth::id() != $user->id)
                              <img id="{{$user->id}}" list={{$list->id}} style="height: 15px;width: 15px" src="{{asset('images/icons/delete.svg')}}" class="ml-1 mr-1 post-icons delete-from-list"  />    
                          @endif
                          <br>
                        @endforeach
                        
                        </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="Tweets" role="tabpanel" aria-labelledby="Tweets-tab">
                @foreach ($list->users as $user)
                        @foreach ($user->tweets as $tweet)
                        @if ($user->id == \Auth::id())
                            @continue
                        @endif
                        <div class="row justify-content-md-center border border-top-0">
                          <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                            <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                          
                                <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                            </div>
                          <div class="post"><a href="{{route('profile')}}" class="name-user-profile">{{$tweet->user->name}}</a> <a href="{{route('profile')}}" class="username">{{"@".$tweet->user_id}}</a> -
                            <span><a class="time-post" href="{{route('show_comments',['tweet_id' => $tweet->id, 'back' => 'profile'])}}">{{$tweet->createdAt()}}</a></span> 
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
                                  <img src="{{asset('images/icons_0/comment.svg')}}" class="ml-1 mr-1 post-icons "  /></a><span>{{$tweet->comments->count()}}</span> 
                        
                            
          
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
                                  <img src="{{asset('images/icons_0/like.svg')}}" class="ml-1 mr-1 post-icons like"   id={{$tweet->id}} /><span class="count-like-{{$tweet->id}}" >{{$tweet->likes->count()}}</span>        
                                @else
                                  <img src="{{asset('images/icons_0/like_red.svg')}}" class="ml-1 mr-1 post-icons like"   id={{$tweet->id}} /><span class="count-like-{{$tweet->id}}" >{{$tweet->likes->count()}}</span>
                                @endif
                                
                                <img src="{{asset('images/icons_0/share.svg')}}" class="ml-1 mr-1 post-icons"  />
                                <img src="{{asset('images/icons_0/register.svg')}}" class="ml-1 mr-1 post-icons "  />
                            </div>
                          </div>
                        </div>
                        @endforeach
                @endforeach
                


              </div>
            </div>
            
            
            





              

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suggested Members</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form method="POST" id="form-comment" action="{{route('lists.add.member', ['listId' => $list->id])}}">
                        @csrf
                        <div class="what-is-news">
                          <input  id="new_member"  class="content-post-textarea" style="border: none ;background-color: transparent; resize: none; outline: none;"  placeholder="suggested members"/><br>
                          <select id="livesearch" name="new_member" style="width:100%;display: none"></select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary float-right disabled mr-1 mb-1 " >add</button>
                        <button type="submit" class="btn btn-primary float-right disabled mr-1 mb-1 " data-dismiss="modal" >Close</button>
                      </form>
    
                    </div>
                  </div>
                </div>
              </div>

              
          </div>
          <div class="col-sm right-div">
            <div class="col">
              @include('layouts.right-menu')
            </div>
          
          </div>
        </div>
      </div>

  <script>
      function showResult(str) {
        if (str.length==0) {
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
          return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {

            //console.log(this.response)
            var stuff = JSON.parse(this.response);
            stuff.forEach(function(item) {
                console.log(item)
            })
            var x = document.getElementById("livesearch");
            var option = document.createElement("option");
            option.text = "Kiwi";
            option.id = "1";
            x.add(option);

            /*
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";

            */
          }
        }
        xmlhttp.open("GET","http://localhost/clone-twitter-laravel/public/users/load/"+str,true);
      xmlhttp.send();
}
  </script>

@include('layouts.footer', ['file' => 'home'])
