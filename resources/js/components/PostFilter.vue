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
          <div class="field">
            <p class="control has-icons-right">
              <input class="input"
                     type="text"
                     placeholder="Titel"
                     v-model='filters.title.value'
                     v-on:keyup.enter="filterChange">
              <span class="icon is-small is-right">
                <button class="button is-primary"
                        v-on:click="filterChange"
                        style="pointer-events:initial">
                  <i class="fas fa-search"></i>
                </button>
              </span>
            </p>
          </div>
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
                      v-model=filters.rating.range
                      tooltip="always"
                      tooltipPlacement="bottom"
                      @drag-end='filterChange'>
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

      <multi-checkbox :options=postCategories
                      :init-values=filters.category.value
                      v-model="filters.category.value"
                      @input="filterChange"></multi-checkbox>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      postCategories: Array
    },
    data() {
      return {
        filters: {
          published: {
            typeFilter: "range",
            type: "Date",
            from: "",
            to: ""
          },
          rating: {
            typeFilter: "rangeArray",
            range: [1, 5],
            defaultMin: 1,
            defaultMax: 5
          },
          title: {
            typeFilter: "single",
            type: "String",
            value: ""
          },
          category: {
            typeFilter: "multiple",
            type: "Boolean",
            value: []
          }
        }
      };
    },
    created() {
      // let emptyArray = new Array(this.postCategories.length).fill(0);
      // this.$set(this.filters["category"], "value", emptyArray);
      this.fillInitValuesBasedOnQueryString();
    },
    methods: {
      addZeroFieldToArray(array, key) {
        array.forEach(function(element) {
          element[key] = 0;
        });
      },
      rangeArrayFilterIsDefaultValue(filter) {
        return (
          filter["range"][0] == filter["defaultMin"] &&
          filter["range"][1] == filter["defaultMax"]
        );
      },
      rangeFilterIsDefaultValue(filter) {
        return (
          (filter["from"] == "" || filter["from"] == null) &&
          (filter["to"] == "" || filter["to"] == null)
        );
      },
      assignRangeValueToFilter(key, value) {
        let splitRange = value.split("-");
        this.filters[key]["from"] = splitRange[0];
        this.filters[key]["to"] = splitRange[1];
      },
      assignRangeArrayValueToFilter(key, value) {
        let splitRange = value.split("-");
        this.filters[key]["range"][0] = splitRange[0];
        this.filters[key]["range"][1] = splitRange[1];
      },
      assignMultipleValueToFilter(key, value) {
        let splitMultiple = value.split(",");

        var _this = this;
        splitMultiple.forEach(function(checked) {
          _this.$set(
            _this.filters[key]["value"],
            _this.filters[key]["value"].length,
            checked
          );
        });
      },
      fillInitValuesBasedOnQueryString() {
        const urlParams = new URLSearchParams(window.location.search);

        for (let [key, value] of urlParams.entries()) {
          let currentFilter = this.filters[key];
          if (currentFilter["typeFilter"] == "range") {
            this.assignRangeValueToFilter(key, value);
            continue;
          } else if (currentFilter["typeFilter"] == "rangeArray") {
            this.assignRangeArrayValueToFilter(key, value);
            continue;
          } else if (currentFilter["typeFilter"] == "multiple") {
            this.assignMultipleValueToFilter(
              key,
              value,
              this.filters[key]["value"]
            );
            continue;
          }
          this.filters[key]["value"] = value;
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
          var currentFilter = this.filters[filter];
          var filterString = filter + "=";

          if (currentFilter["typeFilter"] == "range") {
            if (this.rangeFilterIsDefaultValue(currentFilter)) {
              continue;
            }

            filterString += this.createRangeFilterString(currentFilter);
          } else if (currentFilter["typeFilter"] == "rangeArray") {
            if (this.rangeArrayFilterIsDefaultValue(currentFilter)) {
              continue;
            }

            filterString += this.createRangeArrayFilterString(
              currentFilter["range"]
            );
          } else if (currentFilter["typeFilter"] == "single") {
            if (currentFilter["value"] == "") {
              continue;
            }

            let value = currentFilter["value"];

            if (currentFilter["type"] == "String") {
              value = encodeURIComponent(value);
            }

            filterString += value;
          } else if (currentFilter["typeFilter"] == "multiple") {
            let stringToAdd = this.createMultipleFilterString(
              currentFilter["value"]
            );

            if (stringToAdd == "") {
              continue;
            }

            filterString += stringToAdd;
          }

          filterStrings.push(filterString);
        }

        return filterStrings;
      },
      createRangeArrayFilterString(rangeArray) {
        return rangeArray[0] + "-" + rangeArray[1];
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
      },

      createMultipleFilterString(values) {
        return values.join(",");
      }
    }
  };
</script>
<style>
  .width-is-85 {
    width: 85%;
  }
</style>