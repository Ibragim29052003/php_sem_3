/**
 * Настройка Axios для HTTP-запросов
 * - Автоматически добавляет заголовок X-Requested-With
 */
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Настройка Laravel Echo для реального времени
 * - Используется Pusher для веб-сокетов
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Инициализация Echo
window.Echo = new Echo({
    broadcaster: 'pusher', // используем Pusher
    key: import.meta.env.VITE_PUSHER_APP_KEY, // ключ Pusher из .env
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // кластер Pusher
    forceTLS: true // использовать HTTPS
});
