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
                    <h5><strong>Bookmarks</strong></h5> 
                  </div>
                  <div class="col-sm float-right"> 
                    <img src="{{asset('images/icons/icon_home.png')}}" class="float-right icon-home"  />
                  </div>
            </div>
              @foreach ($bookmarks as $bookmark)
                  
                <div class="row justify-content-md-center border border-top-0">
                  <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                    <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                  
                        <img src="{{asset('images/avatar-home.png')}}"  class="rounded-circle profile-home" alt="profile Home">
                    </div>
                  <div class="post"><a href="#" class="name-user-profile">{{$bookmark->user->name}}</a> <a href="#" class="username">{{"@".$bookmark->user_id}}</a> -
                     <span>{{$bookmark->createdAt()}}</span> 
                     <br>
                      <p class="post-content">
                        {{$bookmark->tweet_text}}
                      </p>
                        <img id="{{$bookmark->id}}" style="height: 20px;width: 20px" src="{{asset('images/icons/delete.svg')}}" class="ml-1 mr-1 post-icons delete"  />
                    </div>
                  </div>
                </div>
              @endforeach

          </div>
          @include('layouts.right-menu')
        </div>
      </div>

 
@include('layouts.footer', ['file' => 'home'])
