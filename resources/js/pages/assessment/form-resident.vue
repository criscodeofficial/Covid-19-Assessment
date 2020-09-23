<template>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <div class="card ">
          <div class="card-header">Fields marked with an <span class="color-red">*</span> are required.</div>
          <div class="card-header">Kindly put your correct home address and personal details to allow proper coordination.</div>
            <div class="card-body">
              <form @submit.prevent="validate" @keydown="form.onKeydown($event)">
                <div class="form-group d-flex justify-content-center">
                  <!-- First Name -->
                  <div class="col-md-6">
                    <label for="firstname">{{ $t('firstname') }} <span class="color-red">*</span></label>
                    <input v-model="form.firstname" :class="{ 'is-invalid': form.errors.has('firstname') }" class="form-control" type="text" name="firstname" placeholder="">
                    <has-error :form="form" field="firstname" />
                  </div>
                  <!-- Last Name -->
                  <div class="col-md-6">
                    <label for="lastname">{{ $t('lastname') }} <span class="color-red">*</span></label>
                    <input v-model="form.lastname" :class="{ 'is-invalid': form.errors.has('lastname') }" class="form-control" type="text" name="lastname">
                    <has-error :form="form" field="lastname" />
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <!-- Age -->
                  <div class="col-md-6">
                    <label for="age">{{ $t('age') }} <span class="color-red">*</span></label>
                    <input v-model="form.age" :class="{ 'is-invalid': form.errors.has('age') }" class="form-control" type="text" name="age">
                    <has-error :form="form" field="age" />
                  </div>
                  <!--Gender -->
                  <div class="col-md-6">
                    <label for="gender">{{ $t('gender') }} <span class="color-red">*</span></label>
                    <input v-model="form.gender" :class="{ 'is-invalid': form.errors.has('gender') }" class="form-control" type="text" name="gender">
                    <has-error :form="form" field="gender" />
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <!-- Date of Birth -->
                  <div class="col-md-6">
                    <label for="birthdate">{{ $t('date of birth') }} <span class="color-red">*</span></label>
                    <input v-model="form.date_of_birth" :class="{ 'is-invalid': form.errors.has('date_of_birth') }" class="form-control" type="text" name="date_of_birth">
                    <has-error :form="form" field="date_of_birth" />
                  </div>
                  <!-- Unit No./Zone -->
                  <div class="col-md-6">
                    <label for="unit">{{ $t('unit/zone') }} <span class="color-red">*</span></label>
                    <input v-model="form.unit" :class="{ 'is-invalid': form.errors.has('unit') }" class="form-control" type="text" name="unit">
                    <has-error :form="form" field="unit" />
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <!-- Street -->
                  <div class="col-md-6">
                    <label for="street">{{ $t('street') }} <span class="color-red">*</span></label>
                    <input v-model="form.street" :class="{ 'is-invalid': form.errors.has('street') }" class="form-control" type="text" name="street">
                    <has-error :form="form" field="street" />
                  </div>
                  <!--Brgy -->
                  <div class="col-md-6">
                    <label for="brgy">{{ $t('brgy') }} <span class="color-red">*</span></label>
                    <input v-model="form.brgy" :class="{ 'is-invalid': form.errors.has('brgy') }" class="form-control" type="text" name="brgy">
                    <has-error :form="form" field="brgy" />
                  </div>
                </div>
                
                <!-- Submit Button -->
                <div class="col-md-6">
                  <v-button :loading="form.busy" class="btn btn-dark">
                    {{ $t('submit') }}
                  </v-button>
                  <router-link :to="{ name: 'assessment.confirm-identity' }">
                    {{ $t('next') }}
                  </router-link> 
                </div> 
              </form>
            </div> 
        </div>   
      </div>     
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    form: new Form({
      firstname: '',
      lastname: '',
      age: '',
      gender: '',
      date_of_birth: '',
      unit: '',
      street: '',
      brgy: ''
    }),

  }),

  computed: mapGetters({
    
    userInfo: 'auth/userInfo'
  }),

  created () {
   
    // Fill the form with user data.
    this.form.keys().forEach(key => {
    this.form[key] = this.userInfo[key]
    })
  },

  methods: {
    async validate () {
      // Register the user.
      const { data } = await this.form.post('/api/form-resident');

      // Update the user.
      await this.$store.dispatch('auth/updateUserInfo', { userInfo: data });

      // Redirect home.
      this.$router.push({ name: 'assessment.confirm-identity' });
    },
  }
}
</script>

<style lang="scss">
  .color-red {
    color: red;
  }
</style>