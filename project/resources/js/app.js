import './bootstrap';
import { loadParticles } from "./particles";

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();

// Initialize Particles
loadParticles("tsparticles");

import { initViewTransitions } from './transitions';
initViewTransitions();

import { initScrollAnimations } from './animations';
initScrollAnimations();
