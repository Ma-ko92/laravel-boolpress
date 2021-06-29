const { default: Axios } = require("axios");

var app = new Vue({
    // Elemento
    el: '#root',

    // Data
    data: {
        // Titolo della pagina
        title: 'Lista Post',
        // Array dei post
        posts: []
    },

    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts')
        .then(result => {
            this.posts = result.data.posts
        });
    }
    
});