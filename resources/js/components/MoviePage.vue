<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 mb-2">
                    <form>
                        <input type="text" name="title" placeholder="タイトル" v-model="title">
                        <input type="text" name="cast" placeholder="キャスト" v-model="cast">
                        <input type="text" name="director" placeholder="監督" v-model="director">
                        <input type="text" name="time" placeholder="分" v-model="time">
                        <input type="text" name="content" placeholder="あらすじ" v-model="content">
                        <input type="text" name="genre_id" placeholder="ジャンル" v-model="genre_id">
                        <button type="button" class="btn btn-primary" @click="createData">映画追加</button>
                    </form>

                    <form>
                        <input type="text" name="title" placeholder="タイトル" v-model="search_title">
                        <select v-model="search_impression">
                            <option disabled value="">感情を選択して下さい</option>
                            <option value=""></option>
                            <option value="sad">悲しい</option>
                            <option value="funny">面白い</option>
                            <option value="scare">怖い</option>
                            <option value="moved">感動</option>
                        </select>

                        <select v-model="search_genre">
                            <option disabled value="">選択して下さい</option>
                            <option value=""></option>
                            <option v-for="genre in genres" :key="genre.name" :value="genre.id">{{ genre.attributes.name
                                }}
                            </option>
                        </select>

                        <button type="button" class="btn btn-primary" @click="loadData">検索</button>
                    </form>


                    <div class="invalid-feedback d-block" v-for="error in errors">
                        {{error}}
                    </div>
                </div>
            </div>
        </div>
        <movie-list :movies="movies"
                    @movie-has-deleted="deleteData($event)"
                    @movie-has-updated="updateData($event)"
                    @favoriteButton1-count-up="countUpFavorite1($event)"
                    @favoriteButton2-count-up="countUpFavorite2($event)"
                    @favoriteButton3-count-up="countUpFavorite3($event)"
                    @favoriteButton4-count-up="countUpFavorite4($event)"
                    >
        </movie-list>
    </div>

</template>

<script>

    import MovieList from "./MovieList";

    export default {
        name: "MoviePage",
        components: {MovieList},
        data: function () {
            return {
                movies: [],
                title: '',
                cast: '',
                director: '',
                time: '',
                content: '',
                genre_id: '',
                search_title: '',
                search_impression: '',
                search_genre: '',
                sad: '',
                funny: '',
                scare: '',
                moved: '',
                genres: [],
                id: '',
                name: '',
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
            createData: function () {
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('cast', this.cast);
                formData.append('director', this.director);
                formData.append('time', this.time);
                formData.append('content', this.content);
                formData.append('genre_id', this.genre_id);
                let config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                axios.post('/api/v1/movies', formData, config)
                    .then((response) => {
                        this.movies.unshift(response.data.data);

                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors['content'];
                        console.log(error);
                    });
            },
            deleteData: function ($event) {
                const index = this.movies.findIndex(function (movie) {
                    return movie.id === $event;
                });

                if (index !== -1) {
                    this.movies.splice(index, 1);
                }
            },
            countUpFavorite1: function ($event) {
                //console.log('ああああ');

                //console.log($event);
                const index = this.movies.findIndex(function (movie) {
                    //console.log(movie.id);
                    return movie.id === $event.id;
                });
                //console.log(index);

                if (index != -1) {
                    this.movies.splice(index, 1, $event);
                }
            },
            countUpFavorite2: function ($event) {
                //console.log('ああああ');

                //console.log($event);
                const index = this.movies.findIndex(function (movie) {
                    //console.log(movie.id);
                    return movie.id === $event.id;
                });
                //console.log(index);

                if (index != -1) {
                    this.movies.splice(index, 1, $event);
                }
            }, countUpFavorite3: function ($event) {
                //console.log('ああああ');

                //console.log($event);
                const index = this.movies.findIndex(function (movie) {
                    //console.log(movie.id);
                    return movie.id === $event.id;
                });
                //console.log(index);

                if (index != -1) {
                    this.movies.splice(index, 1, $event);
                }
            },
            countUpFavorite4: function ($event) {
                //console.log('ああああ');

                //console.log($event);
                const index = this.movies.findIndex(function (movie) {
                    //console.log(movie.id);
                    return movie.id === $event.id;
                });
                //console.log(index);

                if (index != -1) {
                    this.movies.splice(index, 1, $event);
                }

            },
            updateData: function ($event) {
                const index = this.movies.findIndex(function (movie) {
                    return movie.id === $event.id;
                });
                if (index != -1) {
                    this.movies.splice(index, 1, $event);
                }
            }
        }
    }

</script>

<style scoped>

</style>
