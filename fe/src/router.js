import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routerHistory = createWebHistory()

const router = createRouter({
  history: routerHistory,
  routes: [
    {
      path: '/login',
      name: 'login',
      component: () => import('@/pages/Login.vue'),
      meta: { title: 'Login', auth: true, menu: 'login', bread: 'Login', public: true },
    },
    {
      path: '/',
      name: 'template-admin',
      component: () => import('@/partials/Layout.vue'),
      redirect: '/dashboard',
      children: [
        {
          path: '/dashboard',
          name: 'dashboard',
          component: () => import('@/pages/Dashboard.vue'),
          meta: { title: 'Dashboard', auth: true, menu: 'dashboard', bread: 'Dashboard' },
        },
        {
          path: '/jenis-barang',
          name: 'jenis-barang',
          component: () => import('@/pages/JenisBarang.vue'),
          meta: { title: 'Jenis Barang', auth: true, menu: 'jenis-barang', bread: 'Jenis Barang' },
        },
        {
          path: '/stock-barang',
          name: 'stock-barang',
          component: () => import('@/pages/StockBarang.vue'),
          meta: { title: 'Stock Barang', auth: true, menu: 'stock-barang', bread: 'Stock Barang' },
        },
        {
          path: '/prediksi',
          name: 'prediksi',
          component: () => import('@/pages/Prediksi.vue'),
          meta: { title: 'prediksi', auth: true, menu: 'prediksi', bread: 'Prediksi' },
        },
      ]
    },
  ]
})

router.beforeEach((to, from, next) => {
  const { isAuthenticated } = useAuthStore()

  document.title = `TBRM - ${to.meta.title}`


  const privateRoute = to.matched.some((record) => !record.meta.public)
  const publicRoute = to.matched.some((record) => record.meta.public)

  if (privateRoute && !isAuthenticated) next('/login')
  else if (publicRoute && isAuthenticated) next('/')
  else next()
})

export default router
