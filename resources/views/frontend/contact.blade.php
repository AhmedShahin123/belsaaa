@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

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
                        <li><a href="{{route('frontend.about')}}">من نحن </a></li>

                        <li class="active"><a href="{{route('frontend.contact')}}">تواصل معنا</a></li>
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
        <!--contact us section-->
        <section class="contact-us">
            <div class="container">
                <div class="sub-title">
                    <h2>الوصول إلينا </h2>
                </div>
                <div class="sub-text">
                    <p>تواصل معنا وأخبرنا كيف يمكننا المساعدة.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="contact-det">
                            <div class="row">
                                <div class="col-xs-2 custom-sm">
                                    <div class="contact-icon">
                                        <img class="wow zoomIn" src="{{secure_asset('img/website/map.png')}}">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <h3>العنوان</h3>
                                    <p>طريق الأمير متعب ، الواحة ، الدمام 34252 ، المملكة العربية السعودية
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="contact-det">
                            <div class="row">
                                <div class="col-xs-2 custom-sm">
                                    <div class="contact-icon">
                                        <img class="wow zoomIn" src="{{secure_asset('img/website/mail.png')}}">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <h3>الدعم</h3>
                                    <p>تحدث إلينا وشاهد كيف يمكننا العمل معًا.</p>
                                    <a href="mailto:Info@belsaa.co">Info@belsaa.co</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="contact-det">
                            <div class="row">
                                <div class="col-xs-2 custom-sm">
                                    <div class="contact-icon">
                                        <img class="wow zoomIn" src="{{secure_asset('img/website/phone.png')}}">
                                    </div>
                                </div>
                                <div class="col-xs-10">
                                    <h3>للتواصل</h3>
                                    <p>للمشاكل التقنية والإستفسارات</p>
                                    <a href="tel:+966581266635">966&nbsp;581266635</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-msg">
            <div class="head-title">
                <h2>تواصل معنا برسالة</h2>
            </div>
            <div class="sub-text">
                <p>أسئلة أو تعليقات أو فقط أريد أن أقول مرحبا؟</p>
            </div>
            <div class="container wow fadeInUp">
                @include('includes.partials.messages')
                {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                <div class="row">
                    <div class="col-sm-6">
                        <input required name="email" type="email" class="form-control" placeholder="الرید الإلکتروني">
                    </div>
                    <div class="col-sm-6">
                        <input required name="subject" type="text" class="form-control" placeholder="عنوان الرسالة">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select style="height: 63px" class="form-control" required name="category_id" id="category_id">
                            <option style="height: 63px" selected value disabled>نوع الشکوی</option>
                            @foreach($contactCategories as $id => $name)
                                <option style="height: 63px" value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control" required name="body" placeholder="رسالتك" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn main-btn">ارسال </button>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </section>
        <!--end contact us section-->

        <!-- End Companies -->
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
