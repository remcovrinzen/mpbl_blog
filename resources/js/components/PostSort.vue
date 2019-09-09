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
          { name: "Publiceerdatum nieuw-oud", value: "published_desc" },
          { name: "Publiceerdatum oud-nieuw", value: "published_asc" },
          { name: "Rating hoog-laag", value: "rating_desc" },
          { name: "Rating laag-hoog", value: "rating_asc" }
        ],
        selectedSort: this.defaultSort
      };
    },
    props: {
      defaultSort: {
        type: String,
        default: "published_desc"
      }
    },
    created() {
      this.fillSelectedSortWithURL();
    },
    methods: {
      changeSort() {
        let url = new URL(window.location.href);
        var query_string = url.search;
        var search_params = new URLSearchParams(query_string);
        search_params.set("sort", this.selectedSort);

        if (search_params.get("sort") == this.defaultSort) {
          search_params.delete("sort");
        }
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.href = new_url;
      },
      fillSelectedSortWithURL() {
        let url = new URL(window.location.href);
        let sort = url.searchParams.get("sort");

        if (sort != null) {
          this.selectedSort = sort;
        }
      }
    }
  };
</script>
    