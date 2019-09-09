<template>
  <div class="box hover-opposite"
       @mouseover="hover = true"
       @mouseleave="hover = false">
    <div class="columns">
      <div class="column" :class="{'is-three-quarters': post.rating}">
          <h5 class="title is-5 hover-opposite"
              :class="{'has-text-white':hover}">{{ post.title }}</h5>
      </div>

      <div class="column is-one-quarter" v-if='post.rating'>
          <star-rating :increment=0.25
                       :read-only='true'
                       :rating='post.rating'
                       :star-size=40></star-rating>
      </div>
    </div>

    <article class="media">
      <figure class="media-left"
              style='width:200px;'>
        <p class="image is-4by5"
           v-html="post.image_tag">
          {{ post.image_tag }}
        </p>
      </figure>
      <div class="media-content">
        <div class="content">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut.
            Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
          </p>
        </div>
      </div>
      <div class="media-right text-at-bottom">
        <p>{{ post.display_published }}</p>
      </div>

    </article>
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
