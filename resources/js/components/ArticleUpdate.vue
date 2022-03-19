<template>
    <div>
        <div v-if="hasUpdate">
            Статья была обновлена <button @click.prevent="reload()" class="btn btn-danger">Обновить страницу</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articleId'],
        data() {
            return {
                hasUpdate: false
            }
        },
        mounted() {
            Echo
                .channel('articles.' + this.articleId)
                .listen('ArticleUpdatedReload', (data) => {
                    this.hasUpdate = true;
                });
        },
        methods: {
            reload() {
                window.location.reload();
            }
        }
    }
</script>
