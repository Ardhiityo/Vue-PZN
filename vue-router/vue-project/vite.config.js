import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          'users': [
            './src/components/User.vue',
            './src/components/UserFooter.vue',
            './src/components/UserHeader.vue',
            './src/components/UserOrder.vue',
            './src/components/UserOrderFooter.vue',
            './src/components/UserOrderHeader.vue',
            './src/components/UserProfile.vue',
            './src/components/UserWishlist.vue',
            './src/components/UserWishlistFooter.vue',
            './src/components/UserWishlistHeader.vue',
          ]
        },
      },
    },
  },
})
