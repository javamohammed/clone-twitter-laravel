@include('layouts.header', ['file' => 'profile'])

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
                  <a href="{{route('home')}}"><img src="{{asset('images/icons_profile/back.svg')}}" class="icon-back"  /></a>
                    <h5><strong>Mohammed Aoulad Bouchta</strong></h5> 
                    <p class="number-tweets">44 Tweets</p>
                  </div>
            </div>
            <div class="row justify-content-md-center  border-top-0 pl-0"> 
                <div class="header-container mt-0 ml-0 ">
               
                    <img src="./images/header-profile.jpg" alt="profile Header" class="header-container-image">
                    <img src="./images/avatar-home.png"  class="rounded-circle profile-in-header" alt="profile Home">
                </div>
                <div class="head-box"> 
                    <a href="{{route('profile.show')}}" class="btn btn-outline-primary float-right  mr-1 mb-1 edit-profile-btn">Editer le profil</a>
                </div>
              </div>

              <div class="row  border border-top-0">
                <div class="row  border-top-0 pl-0" > 
                  <div class="mt-0 ml-0 ml-0"  style="padding-left: 25px;">
                    <p>
                      <strong>Mohammed Aoulad Bouchta</strong><br>
                      <span style="color: gray;">@AouladBouchta</span>
                    </p>
                    <p style="color: gray; font-size: small;">
                      <img src="./images/icons_profile/local.svg">Tanger <img src="./images/icons_profile/fb.svg">facebook.com/Motamarred <img src="./images/icons_profile/cal.svg">A rejoint Twitter en août 2009
                    </p>
                    
                    <p style="padding-top: 0;">
                      <span><strong>125</strong> <span style="color: gray;">abonnements</span></span> <span><strong>226</strong> <span style="color: gray;">abonnés</span></span>
                    </p>
                  </div>
                </div>
              </div>
            
            

              @foreach ($tweets as $tweet)
              <div class="row justify-content-md-center border border-top-0">
                <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                  <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
                
                      <img src="./images/avatar-home.png"  class="rounded-circle profile-home" alt="profile Home">
                  </div>
                  <div class="post"><a href="#" class="name-user-profile">{{$tweet->user->name}}</a> <a href="#" class="username">{{"@".$tweet->user_id}}</a>. <span>{{Carbon\Carbon::parse($tweet->created_at)->diffForHumans()}}</span> <br>
                    <p class="post-content">
                      {{$tweet->tweet_text}}
                    </p>
                      <img src="images/icons_0/comment.svg" class="ml-1 mr-1 post-icons "  /> 
                      <img src="images/icons_0/like.svg" class="ml-1 mr-1 post-icons"  />
                      <img src="images/icons_0/share.svg" class="ml-1 mr-1 post-icons"  />
                      <img src="images/icons_0/register.svg" class="ml-1 mr-1 post-icons "  />
                  </div>
                </div>
              </div>
              @endforeach



          </div>
          <div class="col-sm right-div">
            <div class="col">
              @include('layouts.right-menu')
            </div>
            
          </div>
        </div>
      </div>

@include('layouts.footer', ['file' => 'profile'])
