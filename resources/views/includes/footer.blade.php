
    {{-- For Footer --}}

    <footer class="footer-section ">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span> {{ $sitesetting->office_address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                               <div class="cta-text">
                                <h4>Call us</h4>
                                <span> {{ $sitesetting->office_contact }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span>{{ $sitesetting->office_mail }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">

                                <a href="{{ url('/') }}"><img src="{{ asset('uploads/sitesetting/'.$sitesetting->side_logo) }}"
                                        class="img-fluid" alt="logo"></a>
                            </div>
                            <div class="footer-text">
                                @foreach ($abouts as $about)
                                <p>{{ Str::substr($about->description,0,200) }}...</p>
                                @endforeach
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a href="https://www.facebook.com/ktm.logistic/"><i class="fa fa-facebook facebook-bg" aria-hidden="true"></i></a>
                                <i class="fa fa-instagram insta-bg" aria-hidden="true"></i>
                                <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Social Feed</h3>
                            </div>
                            <ul>
                                <div class="fb-page" data-href="https://www.facebook.com/hoteltharuland" data-tabs="timeline" data-width="300" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/hoteltharuland" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hoteltharuland">Hotel Tharuland</a></blockquote></div>
                                {{-- <li><a href="{{ url('/') }}">Home</a></li>
                                @foreach($categories as $category)
                                <li><a href="">{{ $category->title }}</a></li>
                                @endforeach
                                <li><a href="{{ route('About') }}">About Us</a></li>
                                <li><a href="{{ route('Gallery') }}">Gallery</a></li>
                                <li><a href="{{ route('Contact') }}">Contact Us</a></li> --}}


                                {{-- <li><a href="{{ url('/') }}">गृहपृष्ठ</a></li>
                                <li><a href="{{ route('render_about') }}">कार्यालयकाे परिचय</a></li>
                                <li><a href="{{ route('render_team') }}">कर्मचारी विवरण</a></li>
                                <li><a href="{{ route('render_notice') }}">सुचना</a></li>
                                <li><a href="{{ route('render_publication') }}">प्रकाशन</a></li>
                                <li><a href="{{ route('render_tender') }}">बाेलपत्र</a></li>
                                <li><a href="{{ route('render_rules') }}">ऐन तथा नियमावली</a></li>
                                <li><a href="{{ route('render_directot') }}">निर्देशिका</a></li>
                                <li><a href="{{ route('render_press') }}">प्रेस विज्ञप्ति</a></li>
                                <li><a href="{{ route('render_news') }}">समाचार</a></li>
                                <li><a href="{{ route('render_other') }}">अन्य</a></li>
                                <li><a href="{{ route('render_images') }}">फाेटाे ग्यालेरी</a></li>
                                <li><a href="{{ route('render_videos') }}">भिडियाे ग्यालेरी</a></li>
                                <li><a href="{{ route('contact_page') }}">सम्पर्क</a></li> --}}


                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Way to Us</h3>
                            </div>
                            <ul class="quicknepal_link">
                                {{-- <iframe src="{{ $sitesetting->google_maps}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  --}}
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3025.1177291835197!2d-73.97062342548784!3d40.69340473875612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bb881483e1d%3A0x739ed50be05286a!2s441%20Myrtle%20Ave%2C%20Brooklyn%2C%20NY%2011205%2C%20USA!5e0!3m2!1sen!2snp!4v1723013758784!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                            </ul>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2021, All Right Reserved <a href="https:aashatech.com">Aasha Tech Pvt.
                                    Ltd.</a></p>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Policy</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer>


<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}">