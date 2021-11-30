<header class="page__header page__wrapper">
    <div class="page__header-column">
        <a class="" href="{{route('home')}}"><img alt="Wedding Book logo" id="" src="{{ asset('frontend/svg')}}/weddingbook.svg"></a>
        @guest
            &nbsp;
        @else
            <a href="">Welcome, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</a>
        @endguest

    </div>

    <div class="page__header-column">
        <div class="nav-bar-top">
            <div class="nav-bar-top-left">
                <ul class="u-list">
                    <!-- <li><a href="#" class="language-bar">Sinhala</a></li>
                    <li>|</li>
                    <li><a href="#" class="language-bar is-active">English</a></li> -->
                </ul>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------> 
            <div class="nav-bar-top-right">
                <ul class="u-list">
                   <!-- <li><a href="#"><img class="fb-like-us" alt="FB Like Us" id="" src="{{ asset('frontend/images')}}/fb-like-us.png"></a></li> -->
                    @guest
                        <li><a href="{{ route('profile_create') }}"><span class="business-profile" style="background-color:#C25283 ; color:#FDD7E4;"><b>Create Your Business Profile</b></span></a></li>
                        <li><a href="{{ route('login') }}"><span class="business-profile" style="background-color:#C25283 ; color:#FDD7E4;"> <b>Login </b></span></a></li>

                    @else
                        <li><a class="nav-bar-link chips-text s7" href="{{route('vendor_profile')}}">My Account</a></li>

                        <li><a class="nav-bar-link chips-text s7" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                        </li>
                    @endguest
                </ul>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------> 
        </div>
        <div class="nav-bar">
            <ul class="menu" style="z-index: 2;">

            @if(Auth::check() && (Auth::user()->isVendor() ?? false))
                                                <!-- <a href="{{route('vendor_profile')}}" class="s5 btn btn-info">View My
                                                    Profile</a> -->
                                                
                 <li><a href="{{route('vendor_profile')}}" style="background-color:#C25283 ; color:#FFFFFF;" class="link-button-link">View My Profile</a></li> 
                 <li><a href="{{route('vendor_profilealerts')}}" style="background-color:#E56E94 ; color:#FFFFFF;" class="link-button-link">Profile Alerts </a></li> 
                 <li><a href="{{route('vendor_advertisments')}}" style="background-color:#E38AAE ; color:#FFFFFF;" class="link-button-link">Post Your Advertisments</a></li> 
                 <li><a href="{{route('customer_requests')}}" style="background-color:#E5B7CA ; color:#FFFFFF;" class="link-button-link">Customer Requests</a></li> 
            @else                     
                <li><a href="{{route('home')}}" class="" style= "color:#FFFFFF;" ><b>Home</b></a></li>
                <li><a href="{{route('aboutus')}}" style="color:#FFFFFF;" ><b> About Us </b></a></li>

                <li><a href="{{route('contact')}}" style=" color:#FFFFFF;" ><b> Contact Us </b></a></li>
            @endif                              
                <!-- <li><a  style="background-color:#C25283 ; color:#FFFFFF;" ><b></b></a></li> -->
                <li class="slider"></li>
            </ul>
        </div>
    </div>
</header>
