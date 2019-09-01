<template>
    <div>
      <post-list-item :post="post" v-for="(post, index) in posts" :key="index"></post-list-item>
    </div>
</template>
<script>
  export default {
    props: {
      'posts': Array
    }
  };
</script>