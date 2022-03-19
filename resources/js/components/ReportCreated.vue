<template>

</template>
<script>
    export default {
        mounted() {
            Echo
                .private('reports')
                .listen('.report-created', (data) => {
                    alert(data.message + '\n' + data.report);
                });
        },
    }
</script>
