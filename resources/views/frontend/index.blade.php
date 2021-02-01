@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="home-header">
        <!-- Start Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <img src="{{secure_asset('img/website/logo-top.png')}}" alt="logo_img"> </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{route('frontend.index')}}">الرئيسية <span class="sr-only">(current)</span></a></li>
                        <li><a href="{{route('frontend.feature')}}">مميزاتنا</a></li>
                        <li><a href="{{route('frontend.about')}}">من نحن </a></li>
                        <li><a href="{{route('frontend.contact')}}">تواصل معنا</a></li>
                    </ul>
{{--                    <ul class="nav navbar-nav navbar-left">--}}
{{--                        <li class="lang">--}}
{{--                            <a href="#" class="btn main-btn">English </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- End Nav -->
        <!-- Start Slider -->
{{--        <div class="main-slider">--}}
{{--            <div class="container">--}}
{{--                <div class="item">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-5">--}}
{{--                            <div class="text">--}}
{{--                                <h2 class="h1 wow fadeInDown" data-wow-duration="3s">أنجزها بكفاءة</h2>--}}
{{--                                <p class="wow fadeInUp" data-wow-duration="3s">تطبيق بالساعة يقدم حلول سهلة وسريعة للتوظيف المؤقت بموثوقية وجودة عالية.--}}
{{--                                </p>--}}
{{--                                <h5 class=" wow fadeInDown" data-wow-duration="3s">انضم إلينا</h5>--}}

{{--                                <div class=" wow fadeInUp" data-wow-duration="3s">--}}

{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>--}}
{{--                                        <label class="form-check-label" for="exampleRadios1">--}}
{{--                                            &nbsp;  <span>منشأة</span> لنوفر لك أفضل مؤدي المهام--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">--}}
{{--                                        <label class="form-check-label" for="exampleRadios2">--}}
{{--                                            &nbsp; <span>مؤدي مهام</span> لتصلك أحدث فرص العمل--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="Slider-form">--}}
{{--                                    <form>--}}
{{--                                        <div class="row form-group">--}}
{{--                                            <div class="col-md-8 wow fadeInUp" data-wow-duration="2s">--}}
{{--                                                <input type="text" class="form-control "  id="UserName" placeholder="أسم المستخدم">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row form-group">--}}
{{--                                            <div class="col-md-8 wow fadeInUp" data-wow-duration="2s">--}}
{{--                                                <input type="text" class="form-control " id="E-mail" placeholder=" البريد الالكتروني">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row form-group">--}}
{{--                                            <div class="col-md-8 wow fadeInUp" data-wow-duration="2s">--}}
{{--                                                <input type="text" class="form-control"  id="PhonNumber" placeholder="رقم الجوال (اختياري)">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-8 wow fadeInUp" data-wow-duration="2s">--}}
{{--                                                <button type="submit" class="btn btn-primary  btn-block">انضم إلينا</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-7">--}}
{{--                            <div class="img">--}}
{{--                                <img class="img-responsive wow zoomIn" data-wow-duration="3s" src="{{secure_asset('img/website/slider.png')}}" alt="slider_img">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- End Header -->
    <div class="content">

        <div class="seekers custom-padding">
            <div class="container">
                <div class="head-title">
                    <h2> للأفراد الراغبين في تحصيل دخل إضافي </h2>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/undraw_calendar_dutt.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s">حدد أوقات تواجدك للحصول على مهمة</p>
                        </div>
                    </div>
                    <div class="col-sm-1 wow fadeInDown" data-wow-duration="2s" >
                        <div class="social-arrow">
                            <i class="fas fa-chevron-circle-left"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/block2.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s"> سيقوم فريقنا بإرسال مهمة تناسبك في أقرب وقت.</p>
                        </div>
                    </div>
                    <div class="col-sm-1 wow fadeInDown" data-wow-duration="2s" >
                        <div class="social-arrow">
                            <i class="fas fa-chevron-circle-left"></i>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/easy.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s">نفذ مهمتك و احصل على أجرك بالساعه </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Seekers -->

        <div class="seekers seekers2  custom-padding">
            <div class="container">
                <div class="head-title">
                    <h2> للمنشأت الباحثين عن  منفذي مهام للعمل لبعض الوقت </h2>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/easy2.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s">حدد كم شخص تحتاج و متى مع وصف مبسط للمهام المطلوبه و اترك الباقي علينا
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-1 wow fadeInDown" data-wow-duration="2s" >
                        <div class="social-arrow">
                            <i class="fas fa-chevron-circle-left"></i>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/time.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s"> سنقوم بإقتراح الأشخاص المناسبين لك و عند الموافقه سيتم إرسالهم وفق الوقت المحدد</p>
                        </div>
                    </div>
                    <div class="col-sm-1 wow fadeInDown" data-wow-duration="2s" >
                        <div class="social-arrow">
                            <i class="fas fa-chevron-circle-left"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="block">
                            <img class="img-responsive wow fadeInDown" data-wow-duration="2s" src="{{secure_asset('img/website/cash.png')}}">
                            <p class="wow fadeInUp" data-wow-duration="2s">عند الإنتهاء نتيح لك خيارات لدفع الأجور. مع القدرة على تقييم المنفذيين و الاعتراض على الأداء.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Seekers -->
        <!-- End Facilities -->
        <div class="apps custom-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="head-title">
                            <h2>تطبيق بالساعة</h2>
                        </div>
                        <p>كل خطوةٍ صممتْ لتكونَ سلسة ،سهلةً وسريعة</p>
                    </div>
                    <div class="col-md-5 col-md-offset-1 col-sm-6">
                        <h6>ترقبونا على منصتي</h6>
                        <img class="img-responsive" src="{{secure_asset('img/website/apps.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
                        <img src="{{secure_asset('img/website/logo-down.png')}}" alt="logo_img">
                    </div>
                    <h3>أنجزها بكفاءة</h3>
                </div>
                <!-- End Col -->
                <div class="col-md-3">
                    <h6>تواصل معنا</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <ul>
                                <li> <a href="tel:+966598829447"> 966&nbsp;598829447</a> </li>

                                <li> <a href="tel:+966503004588">966&nbsp;503004588</a> </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li> <a href="tel:+966581266635"> 966&nbsp;581266635 </a> </li>
                                <li> <a href="mailto:Info@belsaa.co">Info@belsaa.co</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Col -->
                <div class="col-md-3">
                    <h6>تابعنا</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <ul>
                                <li>
                                    <a href="https://www.instagram.com/appbelsaa/?igshid=1eghbabkjub7b"><i class="fab fa-instagram"></i>appbelsaa@</a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/AppBelsaa"><i class="fab fa-twitter"></i>appbelsaa@</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </footer>
    <div class="copyright">
        <h5>جميع الحقوق محفوظة لموقع <a href="#">بالساعه </a>- تصميم وتطوير فيودكس
        </h5>
    </div>
@endsection

