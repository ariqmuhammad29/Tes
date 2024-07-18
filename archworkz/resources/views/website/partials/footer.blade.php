    <!-- Footer-->
    <footer class="absolute bottom-0 footer bg-custom small text-white-50">
        <div class="container-footer2">
            <div class="concon col-lg-10 small d-md-flex justify-content-between">
                <div class="col-lg-9 col-md-8 small d-md-flex align-items-center">
                    <img class="ml-0 footer-logo"
                        src="{{ asset('storage/' . @$setting->firstWhere('key', 'logo')->value) }}" height="150"
                        alt="">
                    <div class="align-items-center">
                        <ul class="w-full text-left ul-footer">
                            <li class="ml-2">
                                <i class="fa-solid fa-location-dot"></i>
                                <a class="w-full ml-2">{{ @$footer->location }}</a>
                            </li>
                            <li class="ml-2">
                                <i class="fa-solid fa-phone"></i>
                                <a class="ml-2">{{ @$footer->phone_number }}</a>
                            </li>
                            <li class="ml-2">
                                <i class="fa-solid fa-building"></i>
                                <a class="ml-2">{{ @$footer->company_number }}</a>
                            </li>
                            <li class="ml-2">
                                <i class="fa-solid fa-globe"></i>
                                <a class="ml-2">{{ @$footer->website }}</a>
                            </li>
                        </ul>
                        {{-- <ul class="text-left ul-footer">
                            <li class="ml-2">
                                <i class="fa-solid fa-location-dot"></i>
                                <a class="w-full ml-2">{{ @$footer->location }}</a>
                            </li>
                        </ul>
                        <ul class="text-left ul-footer">
                            <li class="ml-2">
                                <i class="fa-solid fa-phone"></i>
                                <a class="ml-2">{{ @$footer->phone_number }}</a>
                            </li>
                        </ul>
                        <ul class="text-left ul-footer">
                            <li class="ml-2">
                                <i class="fa-solid fa-building"></i>
                                <a class="ml-2">{{ @$footer->company_number }}</a>
                            </li>
                        </ul>
                        <ul class="text-left ul-footer">
                            <li class="ml-2">
                                <i class="fa-solid fa-globe"></i>
                                <a class="ml-2">{{ @$footer->website }}</a>
                            </li>
                        </ul> --}}
                    </div>
                </div>
                @foreach ($SocialMedia as $item)
                    <div class="mt-4 col-lg-5 small text-img">
                        <p align="right"><br><img src="{{ asset('static/website/images/archworkz/address2.png') }}"
                                height="102" alt="" usemap="#sosmed"></p>
                        <map name="sosmed">
                            <area shape="circle" coords="155,52,18" href="{{ $item->instagram }}" target="_blank"
                                alt="Instagram">
                            <area shape="circle" coords="195,52,18" href="{{ $item->facebook }}" target="_blank"
                                alt="Facebook">
                        </map>
                    </div>
                @endforeach
            </div>
        </div>
    </footer>
