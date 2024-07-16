// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import SignUp from '../components/SignUp.vue';
import SignIn from '../components/SignIn.vue';
import LandingPage from '@/components/LandingPage.vue';
import ListItem from '@/components/ListItem.vue';

const routes = [
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/signin',
    name: 'SignIn',
    component: SignIn
  }, 
  {
    path: '/', 
    name: 'LandingPage', 
    component: LandingPage
  }, 
  {
    path: '/search', 
    name: 'search',
    component: ListItem
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
