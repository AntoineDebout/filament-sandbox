<template>
    <div class="bg-gray-100 py-10">
      <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Films Populaires</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12">
          <movie-card
              v-for="movie in movies"
              :key="movie.id"
              :movie="movie"
              :movie-genres="movieGenres"
          />
        </div>
      </div>
    </div>
</template>

<script>
import MovieCard from '../../../components/card/movie.vue';

export default {
  components: {
    MovieCard
  },
  props: {
    movies: {
      type: Object,
      required: true,
    },
    movieGenres: {
      type: Object,
      required: true,
    }
  }
}
</script>
