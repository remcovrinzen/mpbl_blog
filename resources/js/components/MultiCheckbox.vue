<template>
  <div>
    <div v-for="(option, index) in options"
         :key="index">
      <label class="checkbox">
        <input type="checkbox"
               :value=option.cat_id
               @change="emitClick"
               v-model="values">
        {{ option.name }}
      </label>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      values: this.initValues,
    };
  },
  props: {
    options: Array,
    initValues: Array,
    index: String,
  },
  methods: {
    emitClick() {
      this.$emit('input', this.values);
    },
  },
};
</script>
