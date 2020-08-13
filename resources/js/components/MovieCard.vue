<template>
    <div>
        <div class="card">
            <div class="card-body">
                <p class="card-text">{{ movie.attributes.title }}</p>
                <div class="justify-content-between">
                    <button type="button" class="btn btn-primary" @click="$emit('edit-button-has-clicked', movie)">編集
                    </button>
                    <button type="button" class="btn btn-danger" @click="deleteData">削除</button>
                    <span class="sr-only">unread messages</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "MovieCard",
        props: ['movie'],
        methods: {
            deleteData: function () {
                axios.delete('/api/v1/movies/' + this.movie.id)
                    .then(() => {
                        this.$emit('posthoge', this.movie.id);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        }
    }
</script>
<style scoped>
</style>
