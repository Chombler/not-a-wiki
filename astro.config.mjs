import { defineConfig } from 'astro/config';

const base = process.env.BASE_PATH || '/realm';

export default defineConfig({
  output: 'static',
  base,
  trailingSlash: 'ignore',
  outDir: './dist',
});
