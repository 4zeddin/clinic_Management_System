import './bootstrap';
import { createApp } from "vue";
import DoctorsSection from "./components/DoctorSection.vue";
import MapSection from "./components/MapSection.vue";
import FooterSection from "./components/FooterSection.vue";
import HeroSection from "./components/HeroSection.vue";

const app = createApp({});

app.component("doctors-section", DoctorsSection);
app.component("map-section", MapSection);
app.component("footer-section", FooterSection);
app.component("hero-section", HeroSection);

app.mount("#app");
