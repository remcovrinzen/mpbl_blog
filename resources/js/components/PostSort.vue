<template>
  <div class="select is-primary">
    <select v-model="selectedSort"
            @change="changeSort">
      <option v-for="(option, index) in postSorts"
              :key="index"
              :value="option.value">{{ option.name }}</option>
    </select>
  </div>
</template>
<script>
export default {
  data() {
    return {
      postSorts: [
        { name: 'Publiceerdatum nieuw-oud', value: 'published_desc' },
        { name: 'Publiceerdatum oud-nieuw', value: 'published_asc' },
        { name: 'Rating hoog-laag', value: 'rating_desc' },
        { name: 'Rating laag-hoog', value: 'rating_asc' },
      ],
      selectedSort: this.defaultSort,
    };
  },
  props: {
    defaultSort: {
      type: String,
      default: 'published_desc',
    },
  },
  created() {
    this.fillSelectedSortWithURL();
  },
  methods: {
    changeSort() {
      const url = new URL(window.location.href);
      const queryString = url.search;
      const searchParams = new URLSearchParams(queryString);
      searchParams.set('sort', this.selectedSort);

      if (searchParams.get('sort') === this.defaultSort) {
        searchParams.delete('sort');
      }
      searchParams.delete('page');

      url.search = searchParams.toString();
      const newUrl = url.toString();
      window.location.href = newUrl;
    },
    fillSelectedSortWithURL() {
      const url = new URL(window.location.href);
      const sort = url.searchParams.get('sort');

      if (sort != null) {
        this.selectedSort = sort;
      }
    },
  },
};
</script>
