<template>
    <div>
        <div class="card">
            <div class="card-body">
                <p class="card-text" @click="$emit('edit-button-has-clicked', movie)">{{ movie.attributes.title }}</p>
                <div class="justify-content-between">
                    <button type="button" class="btn btn-outline-primary" @click="favoriteButton1">
                        悲しい|{{ movie.attributes.sad }} <span class="badge badge-light">
                    </span>
                        <span class="sr-only">unread messages</span>
                    </button>
                    <button type="button" class="btn btn-outline-warning" @click="favoriteButton2">
                        面白い|{{ movie.attributes.funny }} <span class="badge badge-light">
                    </span>
                        <span class="sr-only">unread messages</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" @click="favoriteButton3">
                        怖い|{{ movie.attributes.scare }} <span class="badge badge-light">
                    </span>
                        <span class="sr-only">unread messages</span>
                    </button>
                    <button type="button" class="btn btn-outline-success" @click="favoriteButton4">
                        感動|{{ movie.attributes.moved }} <span class="badge badge-light">
                    </span>
                        <span class="sr-only">unread messages</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "MainCard",
        props: ['movie'],
        methods: {
            favoriteButton1: function () {
                axios.patch('/api/v1/movies/sad/' + this.movie.id)
                    .then(() => {

                        this.$emit('favoriteButton1', this.movie.id);

                    })
                    .catch((error) => {
                        console.log(error);
                    });

            },
            favoriteButton2: function () {
                axios.patch('/api/v1/movies/funny/' + this.movie.id)
                    .then(() => {

                        this.$emit('favoriteButton2', this.movie.id);

                    })
                    .catch((error) => {
                        console.log(error);
                    });

            }, favoriteButton3: function () {
                axios.patch('/api/v1/movies/scare/' + this.movie.id)
                    .then(() => {

                        this.$emit('favoriteButton3', this.movie.id);

                    })
                    .catch((error) => {
                        console.log(error);
                    });

            }, favoriteButton4: function () {
                axios.patch('/api/v1/movies/moved/' + this.movie.id)
                    .then(() => {

                        this.$emit('favoriteButton4', this.movie.id);

                    })
                    .catch((error) => {
                        console.log(error);
                    });

            }
        }
    }
</script>
<style scoped>
</style>
