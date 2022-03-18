<template>

</template>
<script>
    export default {
        props: [],
        data() {
            return {

            }
        },
        mounted() {
            Echo
                .channel('reports')
                .listen('.report-created', (data) => {
                    alert(data.message + '\n' + data.report);
                });
        },
        methods: {

        }
    }
</script>
