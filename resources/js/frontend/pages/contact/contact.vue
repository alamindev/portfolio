<template>
  <v-layout row wrap>
    <v-flex xs12 sm12 >
       <VuePerfectScrollbar class="vue-scroll">
       <v-container>
         <v-layout>
           <v-flex xs12 sm12>  
             <v-form v-model="valid" ref="form">
             <h1 v-animate-css="'fadeInDown'" class="contact-page"><i class="fab fa-studiovinari"></i>Contact<i class="fab fa-studiovinari"></i></h1>
             <v-card v-animate-css="'fadeInUp'">
                  <v-alert v-if="errors"
                        :value="true"
                        type="error"
                      >
                        {{ errors }} Some Field Are Empty!
                      </v-alert>
                  <v-alert v-if="success"
                        :value="true"
                        type="success"
                      >
                        {{ success }}
                      </v-alert>
               <v-card-text> 
                  <v-text-field
                      v-model="contact.name"
                      :rules="contact.nameRules" 
                      label="Write Your Name"
                      required
                    ></v-text-field>
                  <v-text-field
                      v-model="contact.email"
                      :rules="contact.emailRules" 
                      label="Email Address"
                      required
                    ></v-text-field>
                  <v-text-field
                      v-model="contact.subject"
                      :rules="contact.subjectRules" 
                      label="Write Your Subject"
                      required
                    ></v-text-field>
                    <v-textarea
                       v-model="contact.details"
                      label="Write A Message"
                      value=""
                       :rules="contact.detailsRules" 
                      hint="At Least 10 Charecter"
                    ></v-textarea>
              
               </v-card-text>
               <v-card-actions>
                <v-btn  color="success" @click="SendData">Send</v-btn> 
                <v-btn  color="error" @click='reset'>reset</v-btn> 
              </v-card-actions>
             </v-card>
            </v-form>
           </v-flex>
         </v-layout>
       </v-container>
        </VuePerfectScrollbar> 
    </v-flex> 
  </v-layout>
</template>

<script>  
import VuePerfectScrollbar from "vue-perfect-scrollbar";
export default {
  components: {
    VuePerfectScrollbar
  },
  data() {
    return {
      valid: false,
      contact: {
          name: '', 
          nameRules: [
              (v) => !!v || 'Name is required',
          (v) => v && v.length >= 2 || 'Name must be less than 2 characters'
          ],
          email: '',
          emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
          ],
          subject: '',
          subjectRules: [
             (v) => !!v || 'Name is required',
            (v) => v && v.length >= 2 || 'Name must be less than 2 characters'
          ],
          details: '',
           detailsRules: [
             (v) => !!v || 'Name is required',
          (v) => v && v.length >= 10 || 'Name must be less than 10 characters'
          ],
      },
      errors: '', 
      success : ''
    }
  },
  methods: {
     SendData(){
       if(this.$refs.form.validate()){
       let url = "/admin/user-contact/store-data";
          let vm = this;
          axios.post(url,this.contact).then(res => { 
             this.success = res.data.message
               this.$refs.form.reset()
          }).catch(error => { 
             this.errors = error.response.data.message
             setTimeout(function () {
                  vm.errors = '';
                }, 3000);
          });
       }
     },
     reset(){
        this.$refs.form.reset();
     }
  },
  created() {
    document.title = "Contact"; 
    
  }
};
</script>
<style lang="scss">
@import url('https://fonts.googleapis.com/css?family=Concert+One');
 .contact-page{
   width: 100%;
   font-family: 'Concert One', cursive;
   text-align: center;
   font-size: 60px;
   font-weight: bold;
   position: relative;
   margin-bottom: 50px; 
   color: #125a77;
   &::before{
      content: "";
      position: absolute;
      left: 0;
      bottom: -10px;
      background: #125a77;
      width: 100%;
      height: 5px;
        z-index: 99; 
    }
    &::after{
        font-family: "Font Awesome 5 Brands";
        font-weight: 400;
        content: "\f50b";
        position: absolute;
        left: 49%;
         top: 65%;
        transform: translate(-50% -50%); 
        z-index: 11; 
        font-size: 55px;
        color: #008aff;
    }
    i{
      color: #008aff;
      opacity: 0.5;  
      &:last-child{
        transform: rotateY(160deg); 
      }
    }
 } 
</style>