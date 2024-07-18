<!--=================================
     header -->

{{-- <header id="header" class="header fancy">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 xs-mb-10">
                    <div class="topbar-call text-center text-md-left">
                        <ul>
                            <li><i class="fa fa-envelope-o theme-color"></i>  
                                {{ @$setting->firstWhere('key', 'email')->value }}
                            </li>
                            <li><i class="fa fa-phone"></i> 
                                <a href="tel:{{ @$setting->firstWhere('key', 'phone')->value }}"> <span>{{ @$setting->firstWhere('key', 'phone')->value }} </span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="topbar-social text-center text-md-right">
                        <ul>
                            @foreach(@$SocialMedia as $key => $sosial)
                            <li><a href="{{@$sosial->url}}" target="_blank" title="{{@$sosial->title}}" ><span class="ti-{{@$sosial->type}}"></span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header> --}}

@include('website.partials.navbar')

<!--=================================
header -->