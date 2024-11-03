<template>
  <div class="flex items-center justify-center overflow-x-hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
      <h1 class="text-3xl font-bold text-gray-800 mb-12  text-center">Bienvenue sur votre Bibliothèque de Films & Séries</h1>
      <div class="flex items-center w-full justify-center">
        <a href="/admin/login" class="bg-accent-red text-white py-2 px-4 rounded-md hover:bg-red-500 transition">
          Se connecter
        </a>
      </div>
    </div>
  </div>

  <popular-movies
      :movies="movies"
      :movie-genres="movieGenres"
  />
</template>

<script>
import App from '../Layouts/pages/app.vue';
import PopularMovies from './partials/popular-movies/popular-movies.vue';

export default {
  name: 'home',
  components: {
    PopularMovies,
  },
  layout: [App],
  props: {
    movies: {
      type: Object,
      required: true,
    },
    movieGenres: {
      Object,
      required: true,
    }
  }
};
</script>