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
      input: {
        'index': 'index.html',
        'hello': 'hello.html',
        'counter': 'counter.html',
        'say-hello': 'say-hello.html',
        'style': 'style.html',
        'score': 'score.html',
        'todolist' : 'todolist.html',
        'contact': 'contact.html',
        'product': 'product.html',
        'note': 'note.html',
        'button-app': 'button-app.html',
        'home': 'home.html',
        'profile-app': 'profile-app.html',
      },
    },
  },
})
