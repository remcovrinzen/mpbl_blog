<template>
    <div class="box">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <h5 class="title is-5">{{ post.title }}</h5>
            </div>
          </div>

          <div class="level-right">
            <div class="level-item" v-if='post.rating'>
                <star-rating :increment=0.25 :read-only='true' :rating='post.rating' :star-size=40></star-rating>
            </div>
          </div>
        </div>

  <article class="media">
    <div>
  <figure class="media-left">
    <p class="image is-128x128" v-html="post.image_tag">
      {{ post.image_tag }}
    </p>
  </figure>
  </div>
  <div class="media-content">
    <div class="content">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
      </p>
    </div>
    </div>
  <div class="media-right">
    <p>{{ post.display_published }}</p>
  </div>

</article>
 </div>
</template>
<script>
  export default {
    props: {
      'post': Object
    }
  };
</script>