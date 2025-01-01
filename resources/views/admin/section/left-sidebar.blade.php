<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <!--<div>-->
            <!--<img src="{{asset('/uploads/logo/'.@$web_detail->logo)}}" height="120"  width="120"/>-->
            <!--</div>-->
            <!-- <div class="admin-info">-->
            <!--    <div class="font-strong">{{ Auth::user()->name }}</div>-->
            <!--</div> -->
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{route('home')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">Menu</li>
            <li>
                <a href="{{route('web-setting')}}">
                    <i class="sidebar-item-icon fa fa-internet-explorer"></i>
                    <span class="nav-label">Site Setting</span>
                    <i class="fa fa-cogs arrow"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Categories</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">
                    {{--
                    <li>
                        <a href="">
                            <span class="fa fa-plus"></span>
                            Add Category
                        </a>
                    </li>
                    --}}
                    <li>
                        <a href="{{route('category.index')}}">
                            <span class="fa fa-circle-o"></span>
                            All Category
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Applicants</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

             

                    <li>
                        <a href="{{route('appeal.index')}}">
                            <span class="fa fa-circle-o"></span>
                            All Applicants
                        </a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Products</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{route('product.create')}}">
                            <span class="fa fa-plus"></span>
                            Add Product
                        </a>
                    </li>

                    <li>
                        <a href="{{route('product.index')}}">
                            <span class="fa fa-circle-o"></span>
                            All Products
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Teams</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/back_team/create">
                            <span class="fa fa-plus"></span>
                            Add Team
                        </a>
                    </li>

                    <li>
                        <a href="/back_team">
                            <span class="fa fa-circle-o"></span>
                            All Teams
                        </a>
                    </li>
                </ul>
            </li> -->
            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-medium"></i>
                    <span class="nav-label">Media</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/video/create">
                            <span class="fa fa-plus"></span>
                            Add Media
                        </a>
                    </li>

                    <li>
                        <a href="/video">
                            <span class="fa fa-circle-o"></span>
                            All Media
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa-solid fa-power-off"></i>

                    <span class="nav-label">Sustain</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/sustain/create">
                            <span class="fa fa-plus"></span>
                            Add Sustain
                        </a>
                    </li>

                    <li>
                        <a href="/sustain">
                            <span class="fa fa-circle-o"></span>
                            All Sustain
                        </a>
                    </li>
                </ul>
            </li> -->



            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Client</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/customer/create">
                            <span class="fa fa-plus"></span>
                            Add Client
                        </a>
                    </li>
                    <!-- <li>
                        <a href="/map/create">
                            <span class="fa fa-plus"></span>
                            Add Map
                        </a>
                    </li> -->
                    <li>
                        <a href="/customer">
                            <span class="fa fa-circle-o"></span>
                            All Clients
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-image"></i>
                    <span class="nav-label">Banner_Image</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                 <!-- <li>
                       <a href="/banner/create">
                           <span class="fa fa-plus"></span>
                         Add Banner 
                        </a>
                    </li> -->

                    <li>
                        <a href="/admin/banner">
                            <span class="fa fa-circle-o"></span>
                            All Banner
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-certificate"></i>
                    <span class="nav-label">Certificate</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/document/create">
                            <span class="fa fa-plus"></span>
                            Add Certificate
                        </a>

                    <li>
                        <a href="/document">
                            <span class="fa fa-circle-o"></span>
                            All Certificates
                        </a>
                    </li>
                </ul>
            </li>  -->
            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Recognization</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/recognization/create">
                            <span class="fa fa-plus"></span>
                            Add Recognization
                        </a>
                    </li>

                    <li>
                        <a href="/recognization">
                            <span class="fa fa-circle-o"></span>
                            All Recognizations
                        </a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-address-card"></i>
                    <span class="nav-label">About Us</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <!--<li>-->
                    <!--    <a href="/satya_story/create">-->
                    <!--        <span class="fa fa-plus"></span>-->
                    <!--        Add Story-->
                    <!--    </a>-->
                    <!--</li>-->

                    <li>
                        <a href="/about_us">
                            <span class="fa fa-circle-o"></span>
                            All About
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-suitcase"></i>
                    <span class="nav-label">Career</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/position/create">
                            <span class="fa fa-plus"></span>
                            Add Career
                        </a>
                    </li>

                    <li>
                        <a href="/position">
                            <span class="fa fa-circle-o"></span>
                            All Career
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-address-book"></i>
                    <span class="nav-label">Quote</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse"> -->

            {{-- <li>
                        <a href="/quote/create">
                            <span class="fa fa-plus"></span>
                            Add Quote
                        </a>
                    </li> --}}

            <!-- <li>
                        <a href="/quote">
                            <span class="fa fa-circle-o"></span>
                            All Quotes
                        </a>
                    </li>
                </ul>
            </li> -->
            <!-- 
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-gear"></i>
                    <span class="nav-label">Process</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="/operation/create">
                            <span class="fa fa-plus"></span>
                            Add Process
                        </a>
                    </li>

                    <li>
                        <a href="/operation">
                            <span class="fa fa-circle-o"></span>
                            All Process
                        </a>
                    </li>
                </ul>
            </li> -->


            <!-- 
            <li>
                <a href="{{route('order-list')}}">
                    <i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Order list </span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li> -->

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Sliders</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{route('slider.create')}}">
                            <span class="fa fa-plus"></span>
                            Add Slider
                        </a>
                    </li>

                    <li>
                        <a href="{{route('slider.index')}}">
                            <span class="fa fa-circle-o"></span>
                            All Slider
                        </a>
                    </li>
                </ul>
            </li>


            <!-- 
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Blogs</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{route('post.create')}}">
                            <span class="fa fa-plus"></span>
                            Add Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{route('post.index')}}">
                            <span class="fa fa-circle-o"></span>
                            All Blog
                        </a>
                    </li>
                </ul>
            </li> -->

            <!--<li>-->
            <!--    <a href="javascript:;">-->
            <!--        <i class="sidebar-item-icon fa fa-sitemap"></i>-->
            <!--        <span class="nav-label">Galleries</span>-->
            <!--        <i class="fa fa-angle-left arrow"></i>-->
            <!--    </a>-->
            <!--    <ul class="nav-2-level collapse">-->
            <!--        <li>-->
            <!--            <a href="{{route('gallery.create')}}">-->
            <!--                <span class="fa fa-plus"></span>-->
            <!--                Add new Gallery-->
            <!--            </a>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <a href="{{route('gallery.index')}}">-->
            <!--                <span class="fa fa-circle-o"></span>-->
            <!--                All Galleries-->
            <!--            </a>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</li>-->






            <li>




                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Pages</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{route('pageCategory', 'article')}}">
                            <span class="fa fa-circle-o"></span>
                            Text pages
                        </a>
                    </li>

                    <!--<li>-->
                    <!--    <a href="{{route('pageCategory', 'legal')}}">-->
                    <!--        <span class="fa fa-circle-o"></span>-->
                    <!--        Legal Pages-->
                    <!--    </a>-->
                    <!--</li>-->

                    <!--<li>-->
                    <!--    <a href="{{route('pageCategory', 'other-page')}}">-->
                    <!--        <span class="fa fa-circle-o"></span>-->
                    <!--        SEO-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </li>
            <li>
                <a href="{{route('list-all-message')}}">
                    <i class="sidebar-item-icon fa fa-snapchat-ghost"></i>
                    <span class="nav-label">Contact & Messages</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            {{--
                <li>
                   <a href="{{route('list-subscriber')}}">
            <i class="sidebar-item-icon fa fa-thumbs-up"></i>
            <span class="nav-label">Subscribers</span>
            <i class="fa fa-angle-left arrow"></i>
            </a>
            </li>
            --}}






        </ul>
    </div>
</nav>