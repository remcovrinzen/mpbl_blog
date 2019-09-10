<template>
  <div class="card" @mouseover="hover = true" @mouseleave="hover = false"
   :class="{'hovered': hover}">
    <div class="card-header">
      <div class="card-header-title">
        {{ post.title }}
      </div>
    </div>

    <div class="card-image">
      <figure class="image is-4by5" v-html="post.image_tag">
        {{ post.image_tag }}
      </figure>
    </div>

    <div class="card-content">
      <div class="level">
        <div class="level-left">
          <div class="level-item" v-if="post.review">
            <star-rating :increment=0.25 :read-only='true' :rating='post.review.rating' :star-size=20  :show-rating='false'
             v-if=post.review.rating></star-rating>
          </div>
        </div>
        <div class="level-right">
          {{ post.display_published }}
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      hover: false,
    };
  },
  props: {
    post: Object,
  },
};
</script>
<style scoped>
  .card {
  transition: all 0.5s;
}
.card.hovered {
  transform: scale(1.1);
  opacity: 0.5;
}
</style>
