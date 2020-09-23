<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Welcome To Your City!</h4></div>
                <div class="card-body">
                    <div class="card p-3 text-break text-justify">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos repellendus iste dolore maiores eaque recusandae, 
                            dicta nobis minima magnam sit necessitatibus aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta! 
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos repellendus iste dolore maiores eaque recusandae, 
                            dicta nobis minima magnam sit necessitatibus aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta! 
                        
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos repellendus iste dolore maiores eaque recusandae, 
                            dicta nobis minima magnam sit necessitatibus aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta!
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            <br>
                        </p>
                        <h6>Do you concent in taking this assesssment?</h6>
                    </div>
                    <div class="form-group mt-3">
                        <ul class="list-group" >
                            <li class="list-group-item" v-for="tab in tabs" :key="tab.route">
                            
                                <router-link :to="{ name: tab.route }">{{ tab.name}}</router-link>
                                
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Concent",

        computed: {
            tabs () {
                return [
                    {
                    icon: 'user',
                    name: this.$t('yes, i agree'),
                    route: 'assessment.form-resident'
                    },

                    {
                    icon: 'lock',
                    name: this.$t('no'),
                    route: 'welcome'
                    },
                ]
            }
        }    
    };
</script>

<style lang="scss">
    .formgroup {
        text-align: center;
    }
</style>
