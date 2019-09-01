<template>
    <div class="box">
        <h5 class="title is-5">{{ post.title }}</h5>

        <p v-html="post.content_summary">
            {{ post.content_summary }}
        </p>
    </div>
</template>
<script>
  export default {
    props: {
      'post': Object
    }
  };
</script>