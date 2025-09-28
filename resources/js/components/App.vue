<template>
    <!-- Показываем уведомление о новой статье, если оно есть -->
    <div v-if="article" class="alert alert-primary" role="alert">
        Добавлена новая статья:
        <!-- Ссылка на новую статью -->
        <strong><a :href="`/article/${article.id}`">{{ article.name }}</a></strong>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // Хранение данных о новой статье
            article: null
        }
    },
    created() {
        // Подписка на канал 'test' через Laravel Echo
        // Слушаем событие NewArticleEvent
        window.Echo.channel('test').listen('NewArticleEvent', (event) => {
            console.log(event); // Вывод события в консоль
            this.article = event.article; // Обновление локальной переменной article
        });
    }
}
</script>
