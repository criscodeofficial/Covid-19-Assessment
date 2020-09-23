<template>
  <div>
    <div class="top-right links">
      <template v-if="authenticated">
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t('register') }}
        </router-link>
      </template>
      <template>
        <router-link :to="{ name: 'about' }">
          {{ $t('about') }}
        </router-link>
      </template>
    </div>
    <div class="text-center">
      <div class="title mb-4">
        {{ title }}
      </div>
      <div class="center-links">
        <template>
          <router-link :to="{ name: 'assessment.consent' }" class="btn-a">
            {{ $t('self assessment') }}
          </router-link>
        </template>
        <!-- <template  v-else>
          <router-link :to="{ name: 'self-assessment' }" class="btn-a">
            {{ $t('self assessment') }}
          </router-link>
        </template> -->
      </div>

      <div class="links">
        <a href="https://github.com/cretueusebiu/laravel-vue-spa">github.com/cretueusebiu/laravel-vue-spa</a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
</style>
