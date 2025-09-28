// Подключение bootstrap.js с настройками Axios и Echo
import './bootstrap';

// Импорт Vue 3
import { createApp } from 'vue';

// Импорт главного компонента
import App from './components/App.vue';

// Создание приложения Vue и монтирование в элемент с id="app"
const app = createApp(App);
app.mount('#app');
