<template>
  <div>
    <div class="page-hero bg-image overlay-dark" loading="lazy" :style="{ backgroundImage: `url(${bgImage})` }">
      <div class="hero-section">
        <div class="container text-center wow zoomIn">
          <span class="subhead font-bold">Let's make your life happier</span>
          <h1 class="display-4 font-bold">Healthy Living</h1>
          <button class="btn btn-primary font-bold">Let's Consult</button>
        </div>
      </div>
    </div>

    <div class="bg-light">
      <div class="page-section py-3 mt-md-n5 custom-index">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-4 py-3 py-md-0" v-for="service in services" :key="service.label">
              <div class="card-service wow fadeInUp">
                <div :class="`circle-shape ${service.bgClass} text-white`">
                  <span :class="service.icon"></span>
                </div>
                <p><span>{{ service.label }}</span></p>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .page-section -->

      <div id="about" class="page-section pb-0">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 py-3 wow fadeInUp">
              <h1>Welcome to Your Health <br> Center</h1>
              <p class="text-grey mb-4">{{ aboutText }}</p>
              <button class="btn btn-primary">Learn More</button>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
              <div class="img-place custom-img-1">
                <img loading="lazy" :src="doctorImage" alt="Doctor">
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .bg-light -->
    </div> <!-- .bg-light -->
  </div>
</template>

<script>
import bgImage from '../../../public/assets/img/bg_image_1.jpg';
import doctorImage from '../../../public/assets/img/bg-doctor.png';

export default {
  data() {
    return {
      bgImage,
      services: [
        {
          label: 'Chat',
          bgClass: 'bg-secondary',
          icon: 'mai-chatbubbles-outline',
        },
        {
          label: 'One-Health Protection',
          bgClass: 'bg-primary',
          icon: 'mai-shield-checkmark',
        },
        {
          label: 'One-Health Pharmacy',
          bgClass: 'bg-accent',
          icon: 'mai-basket',
        },
      ],
      aboutText: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Accusantium aperiam earum ipsa eius, inventore nemo labore eaque porro consequatur ex aspernatur. Explicabo, excepturi accusantium! Placeat voluptates esse ut optio facilis!',
      doctorImage,
    };
  },
};
</script>
