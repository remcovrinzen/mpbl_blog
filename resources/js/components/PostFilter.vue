<template>
  <div>
    <!-- Titel filter -->
    <div class="m-b-lg">
      <div class="m-b-sm">
        <span class="icon">
          <i class="fas fa-search"
             aria-hidden="true"></i>
        </span>
        <b>Zoek op titel</b>
      </div>

      <div class="columns">
        <div class="column">
          <input class="input"
                 type="text"
                 placeholder="Titel">
        </div>
      </div>
    </div>

    <!-- Publiceerdatum filter -->
    <div class="m-b-lg">
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

    <!-- Rating filter -->
    <div class="m-b-xl">
      <div class="m-b-sm">
        <span class="icon">
          <i class="far fa-star"
             aria-hidden="true"></i>
        </span>
        <b>Rating</b>
      </div>

      <div class="columns">
        <div class="column">
          <vue-slider :min=1
                      :max=5
                      :interval=0.25
                      :value=[1,5]
                      tooltip="always"
                      tooltipPlacement="bottom">

          </vue-slider>
        </div>
      </div>

    </div>

    <!-- Categorie filter -->
    <div class="m-b-lg">
      <div class="m-b-sm">
        <span class="icon">
          <i class="fas fa-tag"
             aria-hidden="true"></i>
        </span>
        <b>Categorie</b>
      </div>

      <multi-checkbox :options=test></multi-checkbox>
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
        },
        test: [
          { name: "Recensie", code: 1 },
          { name: "Behind the scenes", code: 2 },
          { name: "Boekreleases", code: 3 },
          { name: "Winacties", code: 4 },
          { name: "Interview", code: 5 },
          { name: "Blogtour", code: 6 },
          { name: "Wrap-up", code: 7 },
          { name: "Evenement", code: 6 }
        ]
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