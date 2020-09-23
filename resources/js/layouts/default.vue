<template>
  <div class="main-layout">
    <navbar />

    <div class="container mt-4 align-items-center justify-content-center">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
