import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import UnoCSS from 'unocss/vite';
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';

const base = process.env.VITE_ASSET_BASE ?? '/app/themes/aura/public/build/';

export default defineConfig({
  base,
  plugins: [
    react(),
    tailwindcss(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/editor.css',
        'resources/js/editor.js',
      ],
      refresh: true,
    }),

    UnoCSS(),
    wordpressPlugin(),

    // Generate the theme.json file in the public/build/assets directory
    // based on the Tailwind config and the theme.json file from base theme folder
    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
    }),

    // Optimize bundled and public images with visually lossless settings.
    ViteImageOptimizer({
      includePublic: true,
      exclude: /sprite(?:-[\w-]+)?\.svg$/i,
      cache: true,
      cacheLocation: 'node_modules/.cache/vite-plugin-image-optimizer',
      png: {
        quality: 100,
        compressionLevel: 9,
        adaptiveFiltering: true,
      },
      jpeg: {
        quality: 85,
        mozjpeg: true,
      },
      jpg: {
        quality: 85,
        mozjpeg: true,
      },
      webp: {
        quality: 85,
        effort: 6,
        smartSubsample: true,
      },
      avif: {
        quality: 65,
        effort: 9,
        chromaSubsampling: '4:4:4',
      },
    }),
  ],
  css: {
    preprocessorOptions: {
      scss: {
        silenceDeprecations: ['import'],
      },
    },
  },
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
  build: {
    manifest: 'manifest.json',
    rollupOptions: {
      input: {
        //app: './src/main.ts',
        auraApp: './resources/js/app.js',
        auraStyle: './src/style.scss',
        editor: './resources/js/editor.js',
        editorStyle: './resources/css/editor.css',
        /*appStyle: './resources/css/app.css',*/
      },
    },
  },
});
