<template>
    <div class="modal" id="movieDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">映画詳細</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <p> タイトル：<input type="text" name="title" placeholder="タイトル" v-model="title"></p>
                            <p> 主演　　：<input type="text" name="cast" placeholder="主演" v-model="cast"></p>
                            <p> 監督　　：<input type="text" name="director" placeholder="監督" v-model="director"></p>
                            <p> 上映時間：<input type="text" name="time" placeholder="上映時間" v-model="time"></p>
                            <!--                            <p> ジャンル：<input type="text" name="genre_id" placeholder="ジャンル" v-model="genre_id"></p>-->

                            <p>ジャンル <select name="genre_id" v-model="genre_id">
                                <option disabled value="">選択して下さい</option>
                                <option value=""></option>
                                <option v-for="genre in genres" :key="genre.name" :value="genre.id">{{
                                    genre.attributes.name
                                    }}
                                </option>
                            </select></p>
                            <p> あらすじ：</p>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                      v-model="content"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary" @click="updateData">更新</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MovieDetailModal",
        data: function () {
            return {
                movie: {},
                title: '',
                cast: '',
                director: '',
                time: '',
                genre_id: '',
                content: '',
                genres: {},
                id: '',
                name: ''

            }
        },
        created: function () {
            this.loadGenreData();
        },
        methods: {
            open: function (movie) {

                this.movie = movie;
                this.title = movie.attributes.title;
                this.cast = movie.attributes.cast;
                this.director = movie.attributes.director;
                this.time = movie.attributes.time;
                this.genre_id = movie.attributes.genre_id;
                this.content = movie.attributes.content;
                $('#movieDetailModal').modal('show');
            },
            close: function () {
                $('#movieDetailModal').modal('hide');
            },
            loadGenreData: function () {
                console.log(this.search_genre);
                console.log('ああああああ');
                axios.get('api/v1/genres'
                    // , {
                    // params: {
                    //     search_genre: this.search_genre
                    // }
                // }
                ).then((response) => {
                        this.genres = response.data.data;

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            updateData: function () {

                axios.patch('/api/v1/movies/' + this.movie.id, {
                    'title': this.title,
                    'cast': this.cast,
                    'director': this.director,
                    'time': this.time,
                    'genre_id': this.genre_id,
                    'content': this.content
                })
                    .then((response) => {
                        this.$emit('movie-has-updated', response.data.data);
                        this.close();
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
