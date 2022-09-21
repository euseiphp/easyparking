import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import header from './modules/header';
import './modules/sweetalert';

window.Alpine = Alpine;

Alpine.plugin(mask)
Alpine.data('header', header);

Alpine.start();
