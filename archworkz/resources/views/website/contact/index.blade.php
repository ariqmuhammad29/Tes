@extends('website.layout')

@section('title')
    Hubungi Kami - {{ @$about->title }}
@stop

@section('scripts')
    <script src="{{ asset('static/website/js/archworkz/jquery-1.12.4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#slider').minislider();
        });
    </script>
    <script>
        AOS.init();
    </script>
@stop

@section('content')

    <style>
        @media (min-width: 1440px) {
            .text-map {
                width: 300px;
                /* height:200px; */
                margin-left: 0;
                margin-right: 0;
            }

            .text-map h1 {
                font-size: 50px;
                position: relative;
                /* text-align: center; */
                color: white;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 700;
                font-style: italic;
            }

            .text-map span {
                position: absolute;
                bottom: 10;
                left: 0;
                right: 0;
                background: var(--blue);
                height: 25%;
                z-index: -1;
            }

            .contact-h1 {
                font-size: 75px;
                color: white;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 700;
                font-style: italic;
            }


            .contact-p {
                font-size: 22px;
                color: white;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 300;
                width: 500px;
            }


            .contact-form {
                background: RGBA(255, 255, 255, 0.37);
                background: RGBA(255, 255, 255, 0.37);
                width: 600px;
                height: 580px;
            }


            .contact-form1 {
                width: 520px;
                height: 540px;
                margin-left: auto;
                margin-right: auto;
                color: white;
                margin-top: 20px;
                margin-top: 20px;
            }


            .contact-form .title {
                font-size: 16px;
                align-items: center;
                display: flex;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 300;
            }


            .contact-form .title1 {
                font-size: 16px;
                margin-top: 20px;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 300;
            }


            .contact-form input {
                width: 400px;
                height: 54px;
            }


            .contact-form textarea {
                width: 400px;
                height: 227px;
            }


            .contact-form button {
                width: 136px;
                height: 30px;
                background: #1F96D3;
                font-size: 12px;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 300;
                color: white;
                border: none;
            }

            .social-media1 {
                margin-top: 0px;
                margin-right: 0px;
            }

            .social-media1 ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
                flex-direction: column;
            }

            .social-media1 ul li {
                justify-content: end;
                display: flex;
                width: 80px;
                margin-top: 10px;
            }

            .social-media1 .fa-brands {
                font-size: 30px;
                color: #C5C3BB;
            }

            .p-map {
                font-size: 20px;
                font-family: "Montserrat", sans-serif;
                font-optical-sizing: auto;
                font-weight: 500;
            }
        }
    </style>


       <!-- Masthead-->
    <header class="masthead-contact" id="home">
        <div class="container-contact">
            <div class="row align-items-center mb-4 mb-lg-5 d-flex justify-content-around">
                <div class="col-xl-8 col-lg-8">
                    <div class="featured-text text-lg-left">
                        <h1 class="contact-h1">CONTACT US</h1>
                        <p class="contact-p">Need get in tauch with team?<br> Feel free to inform us by quoting our form</p>
                        {{-- @if (Session::has('status'))
                            <div id="message"
                                class="absolute left-1/2 bg-green-400 text-white py-2 rounded-xl px-6 transform -translate-x-1/2 top-16 w-1/3">
                                <h2 class="text-center">{{ session('message') }}</h2>

                            </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif --}}

                        {{-- @if (Session::has('status'))
                            @if (session('status') == 'success')
                                <div id="message" class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @elseif (session('status') == 'danger')
                                <div id="message" class="alert alert-danger" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                        @endif --}}
                        {{-- @if (session('status') && session('message'))
                            <div class="alert alert-{{ session('status') }}" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif --}}

                        {{-- <script>
                            setTimeout(function() {
                                $('#statusMessage').fadeOut('slow');
                            }, 3000);
                        </script> --}}
                       <div id="statusMessage" class="col-lg-4" style="margin-bottom: 10px">
                        @if (Session::has('status'))
                            <div class="alert alert-{{ session('status') }} position-relative w-100" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger position-relative w-100" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                        <div class="contact-form position-relative">
                         

                                <form action="{{ route('contact.store') }}" method="post" class="contact-form1">
                                    {{ csrf_field() }}
                                    <div class="d-flex justify-content-between mt-5">
                                        <h5 class="title mt-4">Full Name</h5>
                                        <input class="mt-4" type="text" placeholder="Name" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <h5 class="title">Email</h5>
                                        <input type="text" placeholder="Email" name="email" type="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <h5 class="title">Company</h5>
                                        <input type="text" placeholder="Company" name="company"
                                            value="{{ old('company') }}">
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <h5 class="title1">message</h5>
                                        <textarea name="message" placeholder="Message" value={{ old('message') }} id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4"><button type="submit"
                                            class="">Submit</button></div>



                                </form>
                            
                        </div>
                    </div>
                </div>
                <div class="social-media1">
                    <ul>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

</header>
    <!-- About-->
    <section class="about-contact text-center" id="about">
        <div class="container3">
            @foreach ($contact as $item)
                <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8a col-lg-8" data-aos="fade-right" data-aos-delay="400">
                        {!! $item->map !!}
                    </div>
                    <div class="col-xl-4a col-lg-4a" data-aos="fade-left" data-aos-delay="400">
                        <div class="featured-text text-lg-left">
                            <div class="text-map" data-aos="fade-up" data-aos-delay="400">
                                <h1>OPEN MAP
                                    <span></span>
                                </h1>
                            </div>
                            <p class="text-white mb-5">
                                <strong>Office and Workshop.</strong><br>
                                {{ $item->addres }} <br><br>
                                <strong>Phone.</strong><br>
                                {{ $item->phone_number }}<br><br>
                                <strong>Email.</strong><br>
                                {{ $item->email }}
                            </p>
                        </div>

                    </div>

                </div>
            @endforeach
        </div>
    </section>
@stop
