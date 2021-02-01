@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.feature.box_title'))

@section('content')
    <div class="rest-header">
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
                        <li><a href="{{route('frontend.index')}}">الرئيسية <span class="sr-only">(current)</span></a></li>
                        <li class="active"><a href="{{route('frontend.feature')}}">مميزاتنا</a></li>
                        <li><a href="{{route('frontend.about')}}">من نحن </a></li>

                        <li><a href="{{route('frontend.contact')}}">تواصل معنا</a></li>
                    </ul>
{{--                    <ul class="nav navbar-nav navbar-left">--}}
{{--                        <li class="lang"><a href="#" class="btn main-btn"> English </a></li>--}}
{{--                    </ul>--}}
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- End Nav -->
    </div>
    <!-- End Header -->
    <div class="content">
        <section class="feature-1">
            <div class="container">
                <div class="head-title">
                    <img src="{{secure_asset('img/website/featur.png')}}">
                    <h2>مميزات المستخدم منفذ المهمة</h2>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="wow fadeInRight">
                                <h3>دخل اضافي</h3>
                                <p>
                                    <span> زد من دخلك من خلال تنفيذك للمهام </span>
                                    <span> عن طريق التطبيق
                                        </span>

                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img class="wow fadeInLeft" src="{{secure_asset('img/website/easy.png')}}">
                        </div>
                    </div>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6  ">
                            <img class="wow fadeInRight" src="{{secure_asset('img/website/add.png')}}">
                        </div>
                        <div class="col-sm-6">
                            <div class="wow fadeInLeft">
                                <h3>سهل</h3>
                                <p>
                                    <span>بضغطه واحده احصل على مهمة في</span>
                                    <span>  اي وقت يناسبك
                                        </span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="wow fadeInRight">
                                <h3> اعمل بموقع يناسبك</h3>
                                <p>
                                    <span>احصل على مهمة بمكان قريب منك </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6  ">
                            <img class="wow fadeInLeft" src="{{secure_asset('img/website/join.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="feature-2">
            <div class="container">
                <div class="head-title">
                    <img src="{{secure_asset('img/website/feature2.png')}}">
                    <h2>المميزات لأصحاب المنشآت </h2>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="wow fadeInRight">
                                <h3>توفير</h3>
                                <p>

                                    <span>نوفر عليك التكاليف الغير لازمة للبحث </span>
                                    <span>عن موظفين يدعمونك وقت الحاجة
                                        </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6  ">
                            <img class="wow fadeInLeft" src="{{secure_asset('img/website/save.png')}}">
                        </div>
                    </div>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6  ">
                            <img class="wow fadeInRight" src="{{secure_asset('img/website/time.png')}}">
                        </div>
                        <div class="col-sm-6">
                            <div class="wow fadeInLeft">
                                <h3>الوقت</h3>
                                <p>
                                    <span>نقلل عليك المدة الزمنية لاختيار المرشح</span>
                                    <span> المثالي لكل وظيفة</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="wow fadeInRight">
                                <h3>كفاءة</h3>
                                <p>
                                    <span>نسهل عليك اجراءات التوظيف ونزيد</span>
                                    <span> كفاءتك فيها</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6  ">
                            <img class="wow fadeInLeft" src="{{secure_asset('img/website/easy2.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
                                <li> <a href="tel:+966598829447"> 966&nbsp;598829447 </a> </li>
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
