@include('layouts.header', ['file' => 'profile'])

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
                    
                  <a href="#" data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" data-content="<a href='{{route("lists.on")}}'>List's your on</<a>">
                      <img src="{{asset('images/icons/three_points.svg')}}" style="cursor: pointer;" class="float-right icon-home"  />
                    </a>

                    <a href="#" data-toggle="modal" data-target="#exampleModal" id="add_list">
                      <img src="{{asset('images/icons/lists.svg')}}" style="padding-right:5px; cursor: pointer; " class="float-right icon-home"  />
                    </a>
                    
                  </div>
            </div>
            <div class="lists">
              Your Lists:
             </div>

            @foreach ($lists as $list)
              <div class="row justify-content-md-center border border-top-0 style-list" style="padding-top: 8px;">
                <div class="row justify-content-md-center  border-top-0 pl-0 "> 
                  <div class="float-left mt-0 ml-0  ml-0">
                
                      <img src="https://pbs.twimg.com/media/EXZ2rMvVAAAAfrN?format=png&amp;name=240x240"  class=" profile-home" alt="profile Home">
                  </div>
                <div class="post">
                  <a href="#" class="name-user-profile" style="cursor: pointer">{{$list->name_group}}({{$list->users->count()}})</a><br>
                  <a href="#" class="username">{{'@'.$list->user_id}} {{$list->user->name}}</a> 
                  </div>
                </div>
              </div>
            @endforeach



              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New List</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form method="POST" id="form-comment" action="{{route('lists.save')}}">
                        @csrf
                        <div class="what-is-news">
                          <input name="name_group" class="content-post-textarea" style="border: none ;background-color: transparent; resize: none; outline: none;"  placeholder="Name of new list"/><br>
                        </div>
                        <button type="submit" class="btn btn-primary float-right disabled mr-1 mb-1 " >save</button>
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

  

@include('layouts.footer', ['file' => 'profile'])
