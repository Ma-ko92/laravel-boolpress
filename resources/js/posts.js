// const { default: Axios } = require("axios");

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
        // Se il dominio in cui scriviamo vue è uguale allo stesso dove richiamiamo l'api possiamo omettere di inserire il dominio
        axios.get('/api/posts')
        .then(result => {
            this.posts = result.data.posts
        });
    }
    
});