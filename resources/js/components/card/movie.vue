<template>
  <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105">
    <img
        :src="getImageUrl(movie.poster_path)"
        alt="Affiche du film"
        class="w-full h-auto object-cover"
    />

    <div class="p-4">
      <h2
          v-text="movie.title"
          class="text-lg text-gray-600 font-semibold mb-2"
      />
      <div class="flex flex-row gap-2 mb-4">
        <span
            v-for="id in getMovieGenresLimited(movie.genre_ids)"
            :key="id"
            class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20"
            v-text="getGenreById(id).name"
        >
      </span>
      </div>
      <p
        v-text="movie.overview"
        class="text-xs text-gray-500 mb-2 truncate-multiline"
      />
      <p class="text-gray-600 text-sm mb-2">Sortie : {{ formatDate(movie.release_date) }}</p>
      <div class="flex items-center justify-between">
              <span class="bg-yellow-300 text-yellow-800 px-2 py-1 text-xs font-bold rounded">
                Popularité : {{ movie.popularity.toFixed(0) }}
              </span>
        <span class="text-gray-500 text-sm flex items-center">
                <i class="fas fa-star text-yellow-400 mr-1"></i>
                {{ movie.vote_average }}/10
              </span>
      </div>
    </div>
  </div>
</template>

<script>
import { collect } from 'collect.js';
export default {
  props: {
    movie: {
      type: Object,
      required: true,
    },
    movieGenres: {
      Object,
      required: true,
    }
  },
  methods: {
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('fr-FR', options);
    },
    getImageUrl(path) {
      return `https://image.tmdb.org/t/p/w500${path}`;
    },
    getGenreById(id) {
      return collect(this.movieGenres).where('id', id).first();
    },
    getMovieGenresLimited(genreIds) {
      return collect(genreIds).slice(0, 3).items;
    }
  }
}
</script>
