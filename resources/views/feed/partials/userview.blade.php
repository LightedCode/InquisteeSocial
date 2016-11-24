<div class="card sections" style="overflow:hidden">
    <div class="card-content">
        <div class="col s12 center-align">
            <img src="{{asset(Auth::user()->profile->profilePic->url)}}" class="feed-img responsive-img circle">
        </div>
        <div class="col s12 center-align">
            <span class=""><small>@ {!! Auth::user()->username !!}</small></span>
            <span class=""><h6>{!! Auth::user()->profile->first_name !!} {!! Auth::user()->profile->last_name !!}</h6></span>
        </div>
    </div>
</div>
<div>
    <ul class="collapsible " data-collapsible="accordion">
        <li>
            <div class="collapsible-header truncate">
                <span class="new badge">19</span>Answered your relationship question
            </div>
            <div class="collapsible-body">
                <div class="collection-item">
                    Mozart thinks you are single
                </div>
                <div class="collection-item">
                    Mozart thinks you are single
                </div>
                <div class="collection-item">
                    Mozart thinks you are single
                </div>
                <div class="collection-item">
                    Mozart thinks you are single
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header truncate ">
                <span class="new badge">19</span>Interested In You
            </div>
            <div class="collapsible-body">
                <div class="collection">
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                            <span>@Mozart</span> interested in you
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> interested in you
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> interested in you
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> interested in you
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header truncate">
                <span class="new badge">19</span>Following You
            </div>
            <div class="collapsible-body">
                <div class="collection">
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> Followed You
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> Followed You
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> Followed You
                    </div>
                    <div class="collection-item avatar">
                        <img src="images/profile/myAvatar.png" class="circle">
                        <span>@Mozart</span> Followed You
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
