<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<title> @yield('page_title')||{{@$web_detail->company_name}}</title>-->
    <title>{{@$web_detail->company_name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Pw66_6RO7YNUo2qOQZOAW6PEoYhMrMX0t4EaWqk3CEM" />
    

    @yield('meta')

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/lightbox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />


    <link rel="shortcut icon" href="{{asset('/uploads/logo/'.@$web_detail->fab_icon)}}" type="image/x-icon">
    <!--<link rel="shortcut icon" href="{{asset('assets/front/images/favicon.jpg')}}" type="image/x-icon">-->
    @yield('styles')
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <script src="{{asset('/assets/front/js/jquery-3.4.1.min.js')}}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D578N4R1H9"></script>
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="lypDiBGsUiZMfyQv4veB5A" async></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-D578N4R1H9');
</script>

</head>

<body>

    <header>
        <!--<div class="top-header">-->
        <!--    <div class="container">-->
        <!--        <div class="d-flex align-items-center justify-content-between">-->
        <!--      <ul class="top-media">-->
        <!--            <li><i class="fa fa-phone" aria-hidden="true"></i>{{ @$web_detail->phone_one }}</li>-->
        <!--            <li><a href="# "><i class="fa fa-envelope" aria-hidden="true"></i>{{@$web_detail->email}}</a></li>-->
        <!--        </ul>-->
        <!--           <ul class=" top-media ">-->
        <!--            {{-- <li><i class="fa fa-facebook" aria-hidden="true"></i></li> --}}-->
        <!--            <li><a href="{{@$web_detail->facebook_page}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
        <!--            <li><a href="{{@$web_detail->twitter_id}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
        <!--            <li><a href="{{@$web_detail->insta_id}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
        <!--        </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="nav-wrapper container">
            <div class="top-menu-bar">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </div>
            <a class="logo-wrapper" href="{{ route('homepage') }}">
                <img src="{{asset('/uploads/logo/'.@$web_detail->logo)}} ">
                {{-- <img src="{{asset('assets/front/images/Satya.png')}}"> --}}
            </a>
            <div class="main-menu">
                <nav>
                    <ul>
                        <li><a href="{{route('homepage')}}">Home</a></li>
                        <li><a href="{{route('story')}}">About Us</a></li>

                        <!-- <li class="main_drop_item">
                            <a class="main-drop-link" href="{{ route('story') }}">
                                About Us
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>


                            <ul class="sub-menu">
                                <li class="dropdown-submenu">
                                    <a href="{{ route('story') }}">About</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="{{route('certificate')}}">Certifications</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="{{route('process')}}">Collection & Processing</a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="{{route('team')}}">Our Team</a>
                                </li>


                            </ul>
                        </li> -->

                        <li class="main_drop_item">

                            <a href="{{ route('allProducts') }}">
                                Products
                                <span class="dropdown-toggle">
                                    <i class="" aria-hidden="true"></i>
                                </span>
                            </a>


                            @if(isset($frontcategories) && $frontcategories->count())

                            <ul class="sub-menu">
                                @foreach($frontcategories as $top_cat)
                                <li class="dropdown-submenu">
                                    <a href="{{route('getProductByCategories',$top_cat->slug)}}">{{@$top_cat->title}}</a>


                                </li>

                                @endforeach





                            </ul>
                            @endif
                        </li>



                        <!--<li><a href="{{route('getProductByCategory', $top_cat->slug)}}">{{@$top_cat->title}}</a></li> -->
                        <!--@if(count($top_cat->products)>0)-->

                        <!--<ul class="dropdown-menu">-->
                        <!--    @foreach($top_cat->products as $sub_cat)-->
                        <!--    <li><a href="{{route('ProductDetail', $sub_cat->slug)}}">{{@$sub_cat->title}}</a></li>-->
                        <!--    {{-- <li><a href="#">Sub Category C2</a></li>-->
                        <!--    <li><a href="#">Sub Category C3</a></li> --}}-->
                        <!--    @endforeach-->
                        <!--</ul>-->
                        <!--@endif-->
                        <!-- <li class="main_drop_item"><a class="main-drop-link" href="{{ route('getProductByCategory', 'products') }}">Products<i class="fa fa-angle-down" aria-hidden="true"></i></a> -->

                        <!-- @if(isset($frontcategories) && $frontcategories->count())

                                    <ul class="sub-menu">

                                        @foreach($frontcategories as $top_cat)
                                        <li><a href="{{route('getProductByCategory', $top_cat->slug)}}">{{@$top_cat->title}}</a></li>
                                        @endforeach

                                    </ul>
                                      @endif -->


                        <!-- @if($products->count() > 0 )
                                <ul class="sub-menu">
                                 @foreach( $products as $product )
                                 <li>
                                    <a href="{{route('ProductDetail', $product->slug)}}">
                                    {{ $product->title }}</a>
                                 </li>
                                  @endforeach
                              </ul>
                              @endif -->
                        <!-- </li> -->

                        <!-- <li><a href="{{route('blogs')}}">Blogs</a></li> -->
                        <!-- <li><a href="{{route('media')}}">Mediaaa</a></li>
                        <li><a href="{{route('sustainibility')}}">Sustanibility</a></li> -->
                        <!-- <li><a href="{{route('career')}}">Careers</a></li> -->
                        <li><a href="{{route('client')}}">Our Clients</a></li>


                        <!--@if(isset($listpage) && $listpage->count())-->
                        <!--@foreach($listpage as $list_page_data)-->
                        <!--@if($list_page_data->show_header == 'yes')-->
                        <!--<li><a href="{{route('getProductByCategory', $list_page_data->slug)}}">{{ ucfirst(@$list_page_data->title) }}</a></li>-->
                        <!--@endif-->
                        <!--@endforeach-->
                        <!--@endif-->
                        <li><a href="{{route('contacts')}}">Contact</a></li>
                        <li>
                            <div class="open-btn">
                                <!-- <i class="fa fa-search" aria-hidden="true"></i> -->

                            </div>
                            <div class="search-wrap">
                                <div class="close-btn"><span></span><span></span></div>
                                <div class="search-area">
                                    <form role="search" method="get" action="{{ route('search-product')}}">
                                        <input type="text" value="" name="key" id="search" placeholder="search">
                                        <input type="submit" id="searchsubmit" value="Search">
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </header>

    <!--<div class="blank-div"></div>-->

    <!-- header section ends -->
    @yield('content')
    <!-- footer section starts -->
    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>



    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>{{ @$web_detail->company_name }}</h3>
                        <p>We are a socially responsible company committed to researching, developing and manufacturing natural products to aid to a good quality of life.</p>
                        <ul class="f-top top-media ">
                            {{-- <li><i class="fa fa-facebook" aria-hidden="true"></i></li> --}}
                            <li><a href="{{@$web_detail->facebook_page}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{@$web_detail->twitter_id}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{@$web_detail->insta_id}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Quick Links</h3>
                        <ul class="footer-llinks">
                            <!-- <li><a href="{{route('blogs')}}">Blogs</a></li> -->
                            <!-- <li><a href="{{route('media')}}">Media</a></li> -->
                            <!-- <li><a href="{{route('sustainibility')}}">Sustanibility</a></li> -->
                            <!-- <li><a href="{{route('career')}}">Careers</a></li> -->
                            <li><a href="{{route('client')}}">Our Clients</a></li>
                            <!-- <li><a href="{{route('terms')}}">Terms and condition</a></li> -->
                            <!--<li><a href="{{route('privacy')}}">Privacy Policy</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-col-wrapper">
                        <h3>Contact Us</h3>
                        <ul class="footer-address footer-llinks">
                            <li>{{ @$web_detail->location }}</li>
                            <li>{{ @$web_detail->phone_one }} {{ (@$web_detail->phone_two) ? ' , '.@$web_detail->phone_two : '' }}</li>
                            <li><a href="mailto:{{@$web_detail->email}}">{{@$web_detail->email}}</a></li>
                            <li><a href="{{route('homepage') }}">{{route('homepage') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-text">
                        <p>All right reserved with {{ @$web_detail->company_name }}</p>
                        <p>Developed by: <a href="https://www.facebook.com/umanga.bhattarai" target="_blank">Umanga Bhattarai</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <script src="{{asset('/assets/front/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('/assets/front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/assets/front/js/lightbox.min.js')}}"></script>
    <script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/front/js/wow.min.js')}}"></script>
    <script src="{{asset('/assets/front/js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>






    @yield('scripts')
    {{-- <script src="{{asset('/assets/front/js/custom.js')}}"></script> --}}
    <script>
        $('.love_us').on('click', function(e) {
            e.preventDefault();
            $('.love_us').html('Submitting.....');
            var feedback = $('#love-submit').serialize();
            if (feedback) {
                $.ajax({
                    url: "{{route('ajax-submit-contact')}}",
                    method: "POST",
                    data: {
                        contact: feedback,
                        _token: "{{csrf_token()}}",
                    },
                    success: function(response) {
                        if (response.status == false) {
                            FailedResponseFromDatabase(response.message);
                            $('.love_us').html('Send Message');
                        }
                        if (response.status == true) {

                            $('input[name=first_name]').val('');
                            $('input[name=last_name]').val('');
                            $('input[name=email]').val('');
                            $('input[name=phone_num]').val('');
                            $('textarea[name=message]').val('');

                            $('.love_us').html('Message Sent').attr('disabled', 'disabled');
                            DataSuccessInDatabase(response.message);
                        }
                    }
                });
            }
        })

        function FailedResponseFromDatabase(message) {
            html_error = "";
            $.each(message, function(meta_info, message) {
                html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> ' + message + '</p>';
            });
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                html: html_error,
                confirmButtonText: 'Close',
                timer: 10000
            });
        }

        function DataSuccessInDatabase(message) {
            Swal.fire({
                // position: 'top-end',
                type: 'success',
                title: 'Done',
                html: message,
                confirmButtonText: 'Close',
                timer: 10000
            });
        }
    </script>
</body>

</html>