<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div v-for="movie in movies">
                        <movie-card :movie="movie"
                                    @posthoge="$emit('movie-has-deleted', $event)"
                                    @edit-button-has-clicked="openModal($event)"
                                  >
                        </movie-card>
                    </div>
                </div>
            </div>
        </div>

        <movie-detail-modal ref="movieDetailModal" @movie-has-updated="$emit('movie-has-updated', $event)">

        </movie-detail-modal>
    </div>
</template>

<script>

    import MovieDetailModal from "./MovieDetailModal";
    import MovieCard from "./MovieCard";

    export default {
        name: "MovieList",
        components: {MovieDetailModal, MovieCard},
        props: ['movies'],
        methods: {
            openModal: function ($event) {
                this.$refs.movieDetailModal.open($event);
            }
        }
    }
</script>
<style scoped>
</style>
