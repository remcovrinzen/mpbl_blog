<template>
  <div>
    <div v-for="(option, index) in options"
         :key="index">
      <label class="checkbox">
        <input type="checkbox">
        {{ option.name }}
      </label>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      options: Array
    }
  };
</script>
<style scoped>
</style>