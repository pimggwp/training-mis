<template>
  <v-carousel height="100%">
    <v-carousel-item
      v-for="(item,i) in items"
      :key="i"
      :src="item.src"
    ></v-carousel-item>
  </v-carousel>
</template>

<script>
  export default {
    data () {
      return {
        items: [
          {
            src: 'https://www.mx7.com/i/1e2/IaXysm.png'
          },
          {
            src: 'https://www.mx7.com/i/2ef/4mNHdi.jpg'
          },
          {
            src: 'https://www.mx7.com/i/036/fRMlMa.png'
          },
        ]
      }
    }
  }
</script>