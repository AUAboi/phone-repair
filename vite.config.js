import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import Icons from "unplugin-icons/vite";
import ckeditor5 from "@ckeditor/vite-plugin-ckeditor5";

export default defineConfig({
  plugins: [
    laravel({
      input: "resources/js/app.js",
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    ckeditor5({ theme: require.resolve("@ckeditor/ckeditor5-theme-lark") }),
    Icons({}),
  ],
  // server: {
  //     host: true
  // }
});
