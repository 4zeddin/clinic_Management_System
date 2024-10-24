<template>
  <div class="page-section banner-home bg-image" :style="{ backgroundImage: `url(${bannerImage})` }">
    <div class="container py-5 py-lg-0">
      <div class="row align-items-center">
        <div class="col-lg-4 wow zoomIn">
          <div class="img-banner d-none d-lg-block">
            <img :src="mobileAppImage" alt="Mobile App">
          </div>
        </div>
        <div class="col-lg-8 wow fadeInRight">
          <h1 class="font-weight-normal mb-3">Get easy access to all features using the One Health Application</h1>
          <a href="#"><img :src="googlePlayImage" alt="Google Play"></a>
          <a href="#" class="ml-2"><img :src="appStoreImage" alt="App Store"></a>
        </div>
      </div>
    </div>
  </div>

  <footer id="contact" class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Editorial Team</a></li>
            <li><a href="#">Protection</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>More</h5>
          <ul class="footer-menu">
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Advertise</a></li>
            <li><a href="#">Join as Doctors</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Our Partner</h5>
          <ul class="footer-menu">
            <li><a href="#">One-Fitness</a></li>
            <li><a href="#">One-Pharmacy</a></li>
            <li><a href="#">One-Live</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">Boulevard Khalid Ibn Al Walid, Laayoune 70000</p>
          <a href="tel:053646316" class="footer-link">053646316</a>
          <a href="mailto:onehealth37@gmail.com" class="footer-link">onehealth37@gmail.com</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">
        Copyright &copy; {{ new Date().getFullYear() }} Azeddine Ait Waalla. All rights reserved.
      </p>
    </div>
  </footer>
</template>

<script>
import bannerImage from '../../../public/assets/img/banner-pattern.svg';
import mobileAppImage from '../../../public/assets/img/mobile_app.png';
import googlePlayImage from '../../../public/assets/img/google_play.svg';
import appStoreImage from '../../../public/assets/img/app_store.svg';

export default {
  name: 'FooterSection',
  data() {
    return {
      bannerImage,
      mobileAppImage,
      googlePlayImage,
      appStoreImage,
    };
  },
};
</script>
