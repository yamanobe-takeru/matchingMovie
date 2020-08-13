<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div v-for="movie in movies">
                        <main-card :movie="movie"
                                   @edit-button-has-clicked="openModal($event)"
                                   @favoriteButton1="$emit('favoriteButton1-count-up', $event)"
                                   @favoriteButton2="$emit('favoriteButton2-count-up', $event)"
                                   @favoriteButton3="$emit('favoriteButton3-count-up', $event)"
                                   @favoriteButton4="$emit('favoriteButton4-count-up', $event)">
                        </main-card>
                    </div>
                </div>
            </div>
        </div>

        <main-detail-modal ref="mainDetailModal" @movie-has-updated="$emit('movie-has-updated', $event)">

        </main-detail-modal>
    </div>
</template>

<script>

    import MainCard from "./MainCard";
    import MainDetailModal from "./MainDetailModal";

    export default {
        name: "MainList",
        components: {MainDetailModal, MainCard},
        props: ['movies'],
        methods: {
            openModal: function ($event) {
                this.$refs.mainDetailModal.open($event);
            }
        }
    }
</script>
<style scoped>
</style>
