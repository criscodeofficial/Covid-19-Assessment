<template>
  <div class="row align-items-center justify-content-center">
    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
