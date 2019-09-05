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
            type: "Date",
            from: "",
            to: ""
          }
        }
      };
    },
    created() {
      this.fillInitValuesBasedOnQueryString();
    },
    methods: {
      fillInitValuesBasedOnQueryString() {
        const urlParams = new URLSearchParams(window.location.search);

        for (let [key, value] of urlParams.entries()) {
          if (this.filters[key]["typeFilter"] == "range") {
            let splitRange = value.split("-");
            this.filters[key]["from"] = splitRange[0];
            this.filters[key]["to"] = splitRange[1];
          }
        }
      },
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
              (filters[filter]["from"] == "" ||
                filters[filter]["from"] == null) &&
              (filters[filter]["to"] == "" || filters[filter]["to"] == null)
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
        // Date object conversion
        if (typeof filterValues["from"] == "object") {
          if (filterValues["from"] != null) {
            filterValues["from"] = filterValues["from"].toLocaleDateString();
          } else {
            filterValues["from"] = "";
          }
        }

        if (typeof filterValues["to"] == "object") {
          if (filterValues["to"] != null) {
            filterValues["to"] = filterValues["to"].toLocaleDateString();
          } else {
            filterValues["to"] = "";
          }
        }

        return filterValues["from"] + "-" + filterValues["to"];
      }
    }
  };
</script>
<style>
  .width-is-85 {
    width: 85%;
  }
</style>