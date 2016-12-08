<!--The Navigation bar of the app-->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">one</a></li>
    <li><a href="#!">two</a></li>
    <li class="divider"></li>
    <li><a href="{{url('/logout')}}">Logout</a></li>
</ul>
<div class="col s12 m5 float-search">
    <div class="card">
        <div class="card-content">
            <div class="col s12" style="min-height:72px">
                <div class="col s12 row margin-min-10 ">
                    <div class="col s2">
                        <img src="" class="feed-img-status circle">
                    </div>
                    <div class="col s10">
                        <p class="username-text" style="color:#757575;">Chibuike Osita</p>
                        <a href=""><small></small></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="nav-wrapper" style="">

        <div class="nav-wrapper red darken-1">
                            @if (Auth::check())
                                <ul class="left">
                                    <li class="nav-notifying">
                                        <a href="{{url('/')}}">

                                            <span class="text"><i class="material-icons">home</i></span>
                                        </a>
                                    </li>
                                    <li  class="nav-notifying">
                                        <a href="{{url('/notifications')}}">
                                            <span class="text"><i class="material-icons">notifications</i></span>
                                        </a>
                                    </li>
                                    <li class="nav-notifying">
                                        <a href="{{url('/messages')}}">
                                            <span class="text"><i class="material-icons">message</i></span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="log-section input-field right">
                                    <div class="log-image row">
                                        @if(empty(Auth::user()->profile->profileMedia->url))
                                            <div class="col s2  dropdown-button" data-activates="dropdown1" ><img class="circle" src="{{asset('images/profile/myAvatar.png')}}"/></div>
                                        @else
                                            <div class="col s2  dropdown-button" data-activates="dropdown1"><img class="circle" src="{{asset(Auth::user()->profile->profileMedia->url)}}"/></div>
                                        @endif

                                        <div class="col s10 center-align"><span>{{Auth::user()->profile->first_name}}</span></div>

                                    </div>
                                </div>
                                {!!Form::open(['url'=>"search/"])!!}
                                <div class="input-field right">
                                    <input id="search" type="search" name="search" required>
                                    <label for="search"><i class="material-icons">search</i></label>
                                    <i class="material-icons">close</i>
                                </div>
                                {!!Form::close()!!}
                            @endif




            <a href="#" class="brand-logo center">Lovenote</a>


        </div>
  </nav>
