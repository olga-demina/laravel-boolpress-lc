<template>
  <div class="container">
    <h2>Lista di post</h2>
    <p>Totale post trovati: {{ totalPosts }}</p>
    <div class="row row-cols-3">
      <!-- Single post -->
      <div v-for="post in posts" :key="post.id" class="col">
        <div class="card mb-3">
          <!-- <img class="card-img-top" src="..." alt="Card image cap" /> -->
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">
              {{ troncateText(post.content, 50) }}
            </p>
          </div>
          <!-- <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
          <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div> -->
        </div>
      </div>
      <!-- /Single post -->
    </div>
    <nav aria-label="...">
      <ul class="pagination">
        <!-- Previos page button -->
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a
            @click="getPosts(currentPage - 1)"
            class="page-link"
            href="#"
            tabindex="-1"
            >Previous</a
          >
        </li>
        <!-- Pages numbers -->
        <li v-for="n in lastPage" :key="n" class="page-item" :class="{ active: currentPage === n }">
          <a @click="getPosts(n)" class="page-link" href="#">{{ n }}</a>
        </li>
        <!-- Next page button -->
        <li class="page-item" :class="{ disabled: currentPage === lastPage }">
          <a @click="getPosts(currentPage + 1)" class="page-link" href="#"
            >Next</a
          >
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Posts",
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: 0,
      totalPosts: 0
    };
  },
  created() {
    this.getPosts(1);
  },
  methods: {
    getPosts(pageNumber) {
      axios
        .get("/api/posts", {
          params: {
            page: pageNumber,
          },
        })
        .then((resp) => {
          this.posts = resp.data.results.data;
          this.currentPage = resp.data.results.current_page;
          this.lastPage = resp.data.results.last_page;
          this.totalPosts = resp.data.results.total;

        });
    },
    troncateText(text, maxCharNumber) {
      // Se il testo è più lungo di maxCharNumber
      // taglia il testo e aggiungi ...
      // Altrimenti ritorna il testo intero
      if (text.length > maxCharNumber) {
        return text.substr(0, maxCharNumber) + "...";
      }
      return text;
    },
  },
};
</script>

<style>
</style>