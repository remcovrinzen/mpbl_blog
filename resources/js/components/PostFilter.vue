<template>
  <div>
    <!-- Publiceerdatum filter -->
    <div>
      <div class="m-b-sm">
        <span class="icon">
          <i class="fas fa-calendar-alt"
             aria-hidden="true"></i>
        </span>
        <b>Publiceerdatum</b>
      </div>

      <div class=columns>
        <div class="column">
          <vuejs-datepicker input-class="input width-is-85"
                            placeholder="Van"
                            :monday-first="true"
                            format='dd-MM-yyyy'
                            :clear-button="true"
                            id="van"
                            v-model="filters.published.from"
                            clear-button-icon="fa fa-times"
                            @input="filterChange"></vuejs-datepicker>
        </div>
        <div class="column">
          <vuejs-datepicker input-class="input width-is-85"
                            placeholder="Tot"
                            :monday-first="true"
                            format='dd-MM-yyyy'
                            :clear-button="true"
                            @input='filterChange'
                            id="tot"
                            v-model="filters.published.to"
                            clear-button-icon="fa fa-times"></vuejs-datepicker>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        filters: {
          published: {
            typeFilter: "range",
            type: "Date"
          }
        }
      };
    },
    methods: {
      filterChange() {
        let queryString = this.createQueryString(this.filters);
        window.location.href = "/posts" + queryString;
      },
      createQueryString() {
        var queryString = "";

        var filterStrings = this.buildFilterStringArray(this.filters);

        if (filterStrings.length > 0) {
          queryString = "?";
        }

        queryString += filterStrings.join("&");

        return queryString;
      },
      buildFilterStringArray(filters) {
        var filterStrings = [];

        for (var filter in this.filters) {
          var filterString = filter + "=";

          if (this.filters[filter].typeFilter == "range") {
            if (
              filters[filter]["from"] == undefined &&
              filters[filter]["to"] == undefined
            ) {
              continue;
            }

            filterString += this.createRangeFilterString(this.filters[filter]);
          }

          filterStrings.push(filterString);
        }

        return filterStrings;
      },
      createRangeFilterString(filterValues) {
        var from = "";
        var to = "";

        if (filterValues["from"] != undefined) {
          if (filterValues["type"] == "Date") {
            from = filterValues["from"].toLocaleDateString();
          }
        }

        if (filterValues["to"] != undefined) {
          if (filterValues["type"] == "Date") {
            to = filterValues["to"].toLocaleDateString();
          }
        }

        return from + "-" + to;
      }
    }
  };
</script>
<style>
  .width-is-85 {
    width: 85%;
  }
</style>