import './bootstrap';
import { createApp } from "vue";
import DoctorsSection from "./components/Users/DoctorSection.vue";
import MapSection from "./components/Users/MapSection.vue";
import FooterSection from "./components/Users/FooterSection.vue";
import HeroSection from "./components/Users/HeroSection.vue";
import AppointmentSection from './components/Users/AppointmentSection.vue';

const app = createApp({});

app.component("doctors-section", DoctorsSection);
app.component("map-section", MapSection);
app.component("footer-section", FooterSection);
app.component("hero-section", HeroSection);
app.component("appointment-section", AppointmentSection);


app.mount("#app");
