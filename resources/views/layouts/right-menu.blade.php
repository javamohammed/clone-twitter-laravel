<div class="col-sm right-div">
    <div class="col">
      <div class="col-sm menu-right">
        <div class="is-happening">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text icon-search-input">🔎</div>
            </div>
            <input type="text" class="form-control" id="search-input" placeholder="Recherche Twitter">
          </div>
          @php
              $tendances = getTendance()
          @endphp
          <div class="row justify-content-md-center border  first-col-right">
            <p style="font-weight: bolder; font-size: 18px; margin-left: 0; padding-left: 0; ">Ce qui se passe</p>
          </div>

          @foreach ($tendances as $tendance)
            <div class="row justify-content-md-center border border-top-0 second-col-right">
              <p class="text-second-col-right">
              {{$tendance->hashtag}}<br>
              <span style="color:gray;">{{number_shorten($tendance->cnt)}} Tweets</span><br>
              </p>
            </div>
          @endforeach

          <div class="row justify-content-md-center border  last-col-right">
            <p style="font-weight: bolder; color: #26A5F2;"><a href="#"></p>
          </div>
        </div>

        <div class="suggestion">
          <div class="row justify-content-md-center border  first-col-right">
            <p style="font-weight: bolder; font-size: 18px; margin-left: 0; padding-left: 0; ">Suggestions</p>
          </div>
          @php
              $suggestions = getSuggestions();
          @endphp
          @foreach ($suggestions as $suggestion)
            <div class="row justify-content-md-center border border-top-0 second-col-right" id={{$suggestion->id."-container"}}>
                <div class="float-left mt-0 ml-0 image-profile-circle ml-0">
          
                  <img src="{{asset('./images/avatar-home.png')}}"  class="rounded-circle profile-suggestion" alt="profile suggestion">
              </div>
                <div class="col-sm float-left ">
                  <a href="#" class="name-user-suggestion">{{$suggestion->name}}</a> <a href="#" class="username">{{$suggestion->id}}</a>
                </div>
                <div class="col-sm float-right"> 
                  <button type="button" id={{$suggestion->id.'|'.Auth::id()}} class="btn btn-outline-primary float-right  mr-1 mb-1 follow-btn suggestion">Suiver</button>
                </div>
            </div>
          @endforeach
         


          <div class="row justify-content-md-center border  last-col-right">
            <p style="font-weight: bolder; color: #26A5F2;"><a href="#" id="more-subscribers">Voir plus</a></p>
          </div>


        </div>

      </div>
    </div>
    
  </div>