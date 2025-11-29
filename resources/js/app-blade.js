import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Export Swiper for global use
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay };
