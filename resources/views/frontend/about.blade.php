@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.about.box_title'))

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
                        <li><a href="{{route('frontend.feature')}}">مميزاتنا</a></li>
                        <li class="active"><a href="{{route('frontend.about')}}">من نحن </a></li>
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
        <section class="about-us">
            <div class="container">
                <div class="sub-title">
                    <h2>عن " بالساعة " </h2>
                </div>
                <div class="sub-text">
                    <p> عملنا جاهدين لنسهل على أصحاب الأعمال عملية التوظيف</p>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="about-content">
                            <div class="about-icon wow fadeInDown">
                                <img src="{{secure_asset('img/website/target.png')}}" alt="">
                            </div>
                            <div class="wow fadeInUp">
                                <h4>هدفنا</h4>

                                <p>
                                    نحن في بالساعة نسعى لتوظيف التقنية بما يخدم سوق العمل و العاملين في تحقيق أقصى قدر ممكن من الفاعلية و الكفاءة. بحيث نسهم في توفير الموارد البشرية اللازمة لسوق العمل بأسهل الطرق و أقلها تكلفة. و نسهم كذالك في تمكين الراغبين في العمل من الوصول إلى الفرص
                                    المناسبة و المجدية.

                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="about-content">
                            <div class="about-icon wow fadeInDown">
                                <img src="{{secure_asset('img/website/eye.png')}}" alt="">
                            </div>
                            <div class="wow fadeInUp">
                                <h4>رؤيتنا</h4>

                                <p>
                                    نتطلع لتقديم نقلة نوعية في الطريقة التي تُنفذ فيها الأعمال، بشكل يضمن الكفاءة و الفاعلية لأصحاب المنشآت، و يُراعي المرونة و المردود المادي للباحثين عن العمل.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="about-content">
                            <div class="about-icon wow fadeInDown">
                                <img src="{{secure_asset('img/website/mission.png')}}" alt="">
                            </div>
                            <div class="wow fadeInUp">
                                <h4>مهمتنا</h4>
                                <p>
                                    نحرص في بالساعة على تطويع التقنية لخدمتكم عن طريق الربط بين أصحاب المنشآت و الباحثين عن العمل.
                                </p>
                            </div>
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
