<template>
    <card>
        <div class="card-header">Fields marked with an <span class="color-red">*</span> are required.</div>
        <div class="row justify-content-center" v-if="questions.length">
            <div class="col-md-11">
                <div class="card-body">
                    <div class="alert alert-danger errors d-flex h-100" v-if=" errors ">
                        <p class="mb-0" v-for="(fieldsError, fieldName) in errors" :key="fieldName">{{ fieldsError[0] }}</p>
                    </div>
                    <form @submit.prevent="postResponse" @keydown="form.onKeydown($event)">
                        <ul class="list-group" v-for="(quest, index) in questions" :key="index">  
                            <li class="list-group-item" v-show="index === questionIndex">
                                <span><strong>{{ quest.question }}</strong><span class="color-red"> *</span></span>
                
                                <div class="mt-4"> 
                                    <ul class="list-group" v-for="(answer, index) in quest.answers" :key="answer.id">
                                        <label for="answer">
                                            <li class="list-group-item">
                                                <!-- Seleting questions with type of radio--> 
                                                <input v-if="quest.id === 2 || quest.id === 3 || quest.id === 5 || quest.id === 6" 
                                                v-model="form.fieldAnswer" 
                                                type="radio"
                                                :name="index" 
                                                :value="answer.answer"
                                                ref="mgAnswer"
                                                @change="
                                                choices(answer.id, quest.id, quest.questionaire_id, index, quest.answers)"
                                                class="mr-2">

                                                <!-- Seleting questions with type of checkbox--> 
                                                <input v-else
                                                v-model="form.fieldAnswer" 
                                                type="checkbox"
                                                :name="index" 
                                                :value="answer.answer"
                                                ref="mgAnswer"
                                                @change="
                                                choices(answer.id , quest.id, quest.questionaire_id, index, quest.answers)"
                                                class="mr-2">

                                                {{ answer.answer}}         

                                            </li>
                                        </label>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        
                        <div v-show="questionIndex === questions.length" class="h-100">
                            <div class="card-header"><h4>Your City will be in touch!</h4></div>
                            <div class="card p-3 text-break text-justify h-100">
                                <div class="d-flex align-items-center justify-content-center h-100" v-for="(result, index) in results" :key="index" 
                                :class="result.status ? 'list-group-item-danger' : 'list-group-item-success'">
                                    <p class="mb-0 p-2" v-if="index === results.length -1"><strong v-if="result.count > 2"> {{result.message_1}} </strong>
                                    <strong v-else> {{result.message_2}}</strong> according to the evaluation.</p>
                                </div>
                                <div class="mt-2">
                                    <p> You may consult if some. 
                                        Dignissimos repellendus iste dolore maiores eaque recusandae, dicta nobis minima magnam sit necessitatibus 
                                        aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta!  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos repellendus iste dolore maiores eaque recusandae, 
                                        dicta nobis minima magnam sit necessitatibus aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta! 
                                    </p>
                                    <p>
                                        If you need transportation from your house to a healthcare facility please contact and . Dignissimos repellendus iste dolore maiores eaque recusandae, 
                                        dicta nobis minima magnam sit necessitatibus aspernatur accusantium totam eum corrupti labore velit. Saepe, soluta!
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    </p>  
                                    <p>Free transporation, call or message us at:</p>
                                    <strong>https://www.freetranspo.com</strong><br>
                                    <strong>8000-0000</strong>
                                </div>
                            </div>
                        </div>
                        
                        <div class="btn-next mt-3" v-if="questionIndex === questions.length">
                            <router-link :to="{ name: 'home' }"  class="btn btn-dark">
                                {{ $t('home') }}
                            </router-link> 
                        </div>
                        <div class="btn-next mt-3" v-else>
                            <button :loading="form.busy" class="btn btn-dark">
                            {{ $t('next') }}
                            </button>
                        </div>
                    </form> 
                </div> 
            </div>
        </div>
    </card>   
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
    //props: ['questionaire_id'],

    data: () => ({
        questionIndex: 0,
        checkedId: true,
        checkedAnswerElem: [],
        form: {
            fieldAnswer: [],
            answer_id: [],
            fieldQuestionaire: [],
            fieldQuestion: [],
            is_suspect: []
        },
       
        errors: null,
        results: []
    }),

    mounted() {
        if (this.questions.length) {
            return;
        }
        
        this.$store.dispatch('auth/fetchQuestions');
    },

    computed: mapGetters({
        questions: 'auth/questions',
        assessmentResult: 'auth/assessmentResult' // for fetching results in other page
    }),

    created () {
        
        // if you wish to add more kind of results
        this.checkedAnswerElem = Array(this.questions.length)

    },

    methods: {

        choices(answer, question, questionaire, i, arrAnswers, checkId) {
              
            // if radio button will store a single data
            if(this.questionIndex === 1 || this.questionIndex === 2 || this.questionIndex === 4 || this.questionIndex === 5) {
            
                this.form.answer_id = answer;  
               
            } else {
                let index = this.form.answer_id.findIndex(a => a === answer)
                if (index >= 0) {
                
                    this.form.answer_id.splice(index, 1)
                } else {
                    this.form.answer_id.push(answer);
                    
                }
            }

            // assign boolean values to the choices
            if((arrAnswers.length - 1) == i) {
                this.form.is_suspect = false
            } else {
                this.form.is_suspect = true
            }
     
            // add data to form fields
            this.form.fieldQuestionaire = questionaire;
            this.form.fieldQuestion =  question;
        },
       

        async postResponse() {
            
            // validate form keys
            this.errors = null;
            const constraints = this.getConstraints();
            console.log(constraints)
            const errors = validate(this.form, constraints);
            console.log(errors);

            if(errors) {
                this.errors = errors;
                
                return;
            }
        
            axios.post("/api/form-1", {
                answer: this.form.fieldAnswer.toString(''),
                formData: this.$data.form
                    
            }).then(response => {
                // return fields to empty array
                this.form.fieldAnswer = [];
                this.form.answer_id = [];

                this.questionIndex++
                // add data to array
                this.results.push(response.data)
                console.log(this.results);
                
            }).catch((error) => {
                console.log(error);
            });
           
        },

        // set validations
        getConstraints() {
                
            return {
        
                fieldAnswer: {
                    length: {
                        minimum: 1,
                        message: 'is required.'
                    }     
                },
            }   
        }
    }, 
}
</script>

<style lang="scss">
    .color-red {
        color: red;
    }
    input[type="radio"], input[type="checkbox"] {
        cursor: pointer;
    }
</style>