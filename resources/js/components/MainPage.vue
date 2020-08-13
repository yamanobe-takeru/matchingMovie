<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 px-1 bg-dark position-fixed" id="sticky-sidebar">
                <p>タイトル <input type="text" name="title" placeholder="タイトル" v-model="search_title"></p>
                <p>感情　　 <select v-model="search_impression">
                    <option disabled value="">感情を選択して下さい</option>
                    <option value=""></option>
                    <option value="sad">悲しい</option>
                    <option value="funny">面白い</option>
                    <option value="scare">怖い</option>
                    <option value="moved">感動</option>
                </select></p>
                <p>ジャンル <select v-model="search_genre">
                    <option disabled value="">選択して下さい</option>
                    <option value=""></option>
                    <option v-for="genre in genres" :key="genre.name" :value="genre.id">{{ genre.attributes.name
                        }}
                    </option>
                </select></p>
                <form>
                    <button type="button" class="btn btn-primary" @click="loadData">検索</button>
                </form>
                <div class="invalid-feedback d-block" v-for="error in errors">
                    {{error}}
                </div>
            </div>
            <div class="col offset-3" id="main">
                <main-list :movies="movies"
                            @favoriteButton1-count-up="countUpImpression($event)"
                            @favoriteButton2-count-up="countUpImpression($event)"
                            @favoriteButton3-count-up="countUpImpression($event)"
                            @favoriteButton4-count-up="countUpImpression($event)"
                >
                </main-list>

            </div>

        </div>
    </div>

</template>

<script>

    import MainList from "./MainList";

    export default {
      name: "MainPage",
        components: {MainList},
        data: function () {
            return {
                movies: [],
                genre_id: '',
                search_title: '',
                search_impression: '',
                search_genre: '',
                genres: [],
                users: [],
                errors: [],
            }
        },
        created: function () {
            this.loadData();
            this.loadGenreData();
        },
        methods: {
            loadData: function () {
                axios.get('api/v1/movies', {
                    params: {
                        search_title: this.search_title,
                        search_impression: this.search_impression,
                        search_genre: this.search_genre
                    }

                })
                    .then((response) => {
                        this.movies = response.data.data;


                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadGenreData: function () {
                axios.get('api/v1/genres', {
                    params: {
                        search_genre: this.search_genre
                    }

                })
                    .then((response) => {
                        this.genres = response.data.data;

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            countUpImpression: function ($event) {
                const index = this.movies.findIndex(function (movie) {
                    console.log(movie.id);
                    return movie.id === $event.id;
                });
                console.log(index);


                  if (index != -1) {
                    this.movies.splice(index, 1, $event);
                  }


            },
        }
    }

</script>

<style scoped>

</style>
