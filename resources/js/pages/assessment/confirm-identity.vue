<template>
    <card :title="$t('confirm your identity')">
        <div class="alert alert-danger errors" v-for="(error, index) in errors" :key="index">
            {{ error.join('\n') }} 
        </div>
        <div class="identity">
            <div><p>Please submit valid identification card as listed below:</p></div>
            <div class="valid-ids">
                <ul>
                    <li>Social Security System(SSS)</li>
                    <li>Land Transportation Office(LTO) Driver's Liscence</li>
                    <li>Senior Citizen ID</li>
                    <li>Professional Regulatory Commision(PRC) ID</li>
                </ul>
            </div>
            <div class="card-body">         
                <form @submit.prevent="uploadImage" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                    <div class="custom-file">    
                        <input type="file" @change="selectImage" class="custom-file-input" name="images" multiple>
                        <label for="file" class="custom-file-label">Select an image</label>
                    </div>

                    <div v-if="imageFile" class="mt-3">
                        <img :src="imageFile" class="figure-img img-fluid rounded" style="max-height:100px;" alt="">
                    </div>
                    <div class="btn-next mt-3">
                        <v-button :loading="form.busy" class="btn btn-dark">
                            {{ $t('next') }}
                        </v-button>
                    </div>
                </form>
                
            </div>
        </div>
    </card>    
</template>

<script>
import Form from 'vform'

import axios from 'axios'
export default {
    data: () => ({

        form: new Form({

            images: null 
        }),
        
        imageFile: null,
        errors: [],
    }),

  methods: {

    selectImage(e) {
    
      this.images = e.target.files[0];

      let reader = new FileReader();

      reader.readAsDataURL(this.images);
    
      reader.onload = e => {
        this.imageFile = e.target.result;
     
        };
    },
   
    async uploadImage() {
        this.errors = [];
        let formData = new FormData();

        formData.append('images', this.images)

        axios.post('/api/confirm-identity', formData)
            .then(response => {

                this.images = null;
                this.imageFile = null;

                // Redirect home.
                this.$router.push({ name: 'assessment.form-1' })
            }).catch(error => {

                if(error.response.status == 422) {
                    this.errors = error.response.data.errors
                }
            })
        } 
    }
}
</script>

<style>

</style>