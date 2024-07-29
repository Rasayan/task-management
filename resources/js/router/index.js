import { createRouter, createWebHistory } from 'vue-router';
import App from '../App.vue'; // Adjust the path if necessary

const routes = [
  {
    path: '/mytasks',
    name: 'MyTasks',
    component: App, // Temporarily use App.vue or create a separate component if needed
  },
  {
    path: '/profile',
    name: 'Profile',
    component: App, // Temporarily use App.vue or create a separate component if needed
  },
  {
    path: '/',
    name: 'Home',
    component: App, // Default route
  },
  {
    path: '/:pathMatch(.*)*', // Catch-all route for 404
    name: 'NotFound',
    component: {
      template: '<div>Page not found</div>'
    }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
