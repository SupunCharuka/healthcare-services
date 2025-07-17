  <!-- main-footer -->
  <footer class="main-footer">
      <div class="footer-top pt-100">
          <div class="pattern-layer">
              <div class="pattern-1"
                  style="background-image: url('{{ asset('assets/frontend/images/shape/shape-30.png') }}');"></div>
              <div class="pattern-2"
                  style="background-image: url('{{ asset('assets/frontend/images/shape/shape-31.png') }}');"></div>
          </div>
          <div class="auto-container">
              <div class="widget-section">
                  <div class="row clearfix">
                      <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                          <div class="footer-widget logo-widget">
                              <figure class="footer-logo"><a href="{{ url('') }}"><img
                                          src="{{ asset('img/footer-logo.png') }}" alt=""></a></figure>
                              <div class="text">
                                  <p>Driven by a passion for quality care, we offer reliable and convenient health services tailored to your needs—ensuring a truly seamless experience.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                          <div class="footer-widget links-widget">
                              <div class="widget-title">
                                  <h3>About</h3>
                              </div>
                              <div class="widget-content">
                                  <ul class="links clearfix">
                                      <li><a href="{{ route('public.aboutUs') }}">About Us</a></li>
                                      <li><a href="{{ route('public.userGuide') }}">How It Works</a></li>
                                      <li><a href="{{ route('public.serviceCategory') }}">Our Services</a></li>
                                      <li><a href="">Our Blog</a></li>
                                      <li><a href="{{ route('public.contactUs') }}">Contact Us</a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                          <div class="footer-widget links-widget">
                              <div class="widget-title">
                                  <h3>Useful Links</h3>
                              </div>
                              <div class="widget-content">
                                  <ul class="links clearfix">
                                     
                                      <li><a href="{{ route('service-provider.register') }}">Join as a Doctor</a></li>
                                      <li><a href="{{ route('policy.show') }}">Privacy Policy</a></li>
                                      <li><a href="">Faq</a></li>
                                      <li><a href="{{ route('terms.show') }}">Term And Condition</a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                          <div class="footer-widget contact-widget">
                              <div class="widget-title">
                                  <h3>Contacts</h3>
                              </div>
                              <div class="widget-content">
                                  <ul class="info-list clearfix">
                                      <li><i class="fas fa-map-marker-alt"></i>
                                          Colombo, Sri Lanka 
                                      </li>
                                      <li><i class="fas fa-microphone"></i>
                                          <a href="tel:+9476 123 4561">+9476 123 4561</a>
                                      </li>
                                      <li><i class="fas fa-envelope"></i>
                                          <a href="mailto:support@myhealthcaredoc.lk">support@healthcare.lk</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer-bottom">
          <div class="auto-container">
              <div class="inner-box clearfix">
                  <div class="copyright pull-left">
                      <p><a href="{{ url('') }}"></a> &copy; {{ date('Y') }} All Right Reserved</p>
                  </div>
                  <ul class="footer-nav pull-right clearfix">
                      <li><a href="{{ route('terms.show') }}">Term And Condition</a></li>
                      <li><a href="{{ route('policy.show') }}">Privacy Policy</a></li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>
  <!-- main-footer end -->
