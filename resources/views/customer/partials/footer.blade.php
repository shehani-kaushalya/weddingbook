
<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="footer-ribbon">
                Get in touch
            </div><!-- End .footer-ribbon -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Contact Us</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">Address: </span> 85/A, Dutugemunu Street Kohuwala.
                            </li>
                            <li>
                                <span class="contact-info-label">Phone:</span>Toll Free <a href="tel:">+94777465406</a>
                            </li>
                            <li>
                                <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">info@amax.lk</a>
                            </li>
                            <li>
                                <span class="contact-info-label">Working Days/Hours:</span>
                                Mon - Sun / 9:00AM - 8:00PM
                            </li>
                        </ul>
                        <div class="social-icons">
                            <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a>
                        </div><!-- End .social-icons -->
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-9">
                    <div class="widget widget-newsletter">
                        <h4 class="widget-title">Subscribe newsletter</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Get all the latest information on Events,Sales and Offers. Sign up for newsletter today</p>
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="Email address" required>

                                    <input type="submit" class="btn" value="Subscribe">
                                </form>
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .widget -->

                    <div class="row">
                        <div class="col-md-5">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>

                                <div class="row">
                                    <div class="col-sm-6 col-md-5">
                                        <ul class="links">
                                            {{-- <li><a href="{{route('viewPage', ['slug' => 'terms'])}}">Terms & Conditions</a></li>
                                            <li><a href="{{route('viewPage', ['slug' => 'privacy-policy'])}}">Privacy Policy</a></li>
                                            <li><a href="{{route('viewPage', ['slug' => 'cookie-policy'])}}">Cookie Policy</a></li> --}}
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6 col-md-5">
                                        <ul class="links">
                                            <li><a href="#">Orders History</a></li>
                                            <li><a href="#">Advanced Search</a></li>
                                            <li><a href="#" class="login-link">Login</a></li>
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="widget">
                                {{--<h4 class="widget-title">Main Features</h4>--}}

                                <div class="row">

                                    <div class="col-6 text-right">

                                        <a href="https://www.rapidssl.com/" target="_blank">
                                        <img src="{{asset('img/ssl.png')}}" alt="SSL Secured" class="footer-payments" width="80">
                                        </a>

                                    </div>

                                    <div class="col-6">
                                        <img src="https://www.payhere.lk/downloads/images/payhere_short_banner.png" alt="payment methods" class="footer-payments" width="250">
                                    </div>

                                    <div class="col-sm-6">
                                        <ul class="links">
                                            {{--<li><a href="#">Super Fast Magento Theme</a></li>--}}
                                            {{--<li><a href="#">1st Fully working Ajax Theme</a></li>--}}
                                            {{--<li><a href="#">20 Unique Homepage Layouts</a></li>--}}
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6">
                                        <ul class="links">

                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <p class="footer-copyright">Amax eCommerce. &copy;  2019.  All Rights Reserved</p>


        </div><!-- End .footer-bottom -->
    </div><!-- End .container -->
</footer><!-- End .footer -->


<div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url({{asset('customer/assets/images/newsletter_popup_bg.jpg')}})">
    <div class="newsletter-popup-content">
        <img src="{{asset('customer/assets/images/logo-black.png')}}" alt="Logo" class="logo-newsletter">
        <h2>BE THE FIRST TO KNOW</h2>
        <p>Subscribe to the Amax newsletter to receive timely updates from your favorite products.</p>
        <form action="#">
            <div class="input-group">
                <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Email address" required>
                <input type="submit" class="btn" value="Go!">
            </div><!-- End .from-group -->
        </form>
        <div class="newsletter-subscribe">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1">
                    Don't show this popup again
                </label>
            </div>
        </div>
    </div><!-- End .newsletter-popup-content -->
</div><!-- End .newsletter-popup -->

</div><!-- End .page-wrapper -->


<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>



<!-- Plugins JS File -->
<script src="{{asset('customer/')}}/assets/js/jquery.min.js"></script>
<script src="{{asset('customer/')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('customer/')}}/assets/js/plugins.min.js"></script>

<!-- Main JS File -->
<script src="{{asset('customer/')}}/assets/js/main.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    (function ($) {
        $(document).on('click','#lg-model-login-btn',function () {
            $.ajax({
                url: 'login',
                method: "POST",
                dataType: 'JSON',
                data: {
                    email: document.getElementById("login-email").value,
                    password: document.getElementById("login-password").value
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                }
            })
        })
    }(jQuery))
</script>
<!--Start of Tawk.to Script-->

    @if(\Illuminate\Support\Facades\Route::currentRouteName() != 'customer.account.pr.single.view')
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/5dfb9248d96992700fcd10bb/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
     @endif

<!--End of Tawk.to Script-->
@section('custom_js')


@show
</body>
</html>
