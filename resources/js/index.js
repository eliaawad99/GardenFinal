// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Home from './Pages/Home.vue'; // Adjust the path as necessary

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  // Add more routes here
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
