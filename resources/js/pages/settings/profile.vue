<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- First Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('firstname') }}</label>
        <div class="col-md-7">
          <input v-model="form.firstname" :class="{ 'is-invalid': form.errors.has('firstname') }" class="form-control" type="text" name="firstname">
          <has-error :form="form" field="firstname" />
        </div>
      </div>

      <!-- Last Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('lastname') }}</label>
        <div class="col-md-7">
          <input v-model="form.lastname" :class="{ 'is-invalid': form.errors.has('lastname') }" class="form-control" type="text" name="lastname">
          <has-error :form="form" field="lastname" />
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      firstname: '',
      lastname: '',
      email: '' 
    })
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]

    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
