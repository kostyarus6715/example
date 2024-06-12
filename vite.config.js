// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
    // Основные настройки
    root: 'C:\\\\OSPanel\\\\domains\\\\example', // Корневая директория проекта
    base: '/', // Базовый путь для размещения ресурсов
    build: {
        outDir: '../public', // Директория для выходных файлов сборки
        assetsDir: '', // Поддиректория для статических ресурсов
        manifest: true, // Генерация файла манифеста для ресурсов
        minify: 'terser', // Минификация с использованием Terser
        sourcemap: true, // Генерация sourcemaps для отладки
    },
});
