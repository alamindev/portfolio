<template>
    <section>
        <div class="card">
            <div class="card-header">
                Upload Avater
            </div>
            <div class="card-body">
                <div v-if="!getImg || getImg == 'photo'">
                    <div class="upload-body" v-if="!croped">
                    <vue-avatar
                        :width=400
                        :height=400
                        ref="vueavatar"
                        @vue-avatar-editor:image-ready="onImageReady"
                        :image="oldImage"
                    >
                    </vue-avatar>
                    <vue-avatar-scale
                        ref="vueavatarscale"
                        @vue-avatar-editor-scale:change-scale="onChangeScale"
                        :min=1
                        :max=10
                        :step=0.02
                    >
                    </vue-avatar-scale>
                    <button type="button" v-on:click="saveClicked" class="btn btn-outline-success waves-effect waves-light btn-block  mt-2">Crop</button>
                    </div>
                    <div v-else>
                        <form @submit.prevent="Upload">
                            <img :src="image.photo"  id="img-1" class="img-fluid">   
                            <button type="submit" class="btn btn-success waves-effect waves-light btn-block  mt-2">Upload</button>
                            <button type="button" v-on:click="Cancel"   class="btn btn-outline-info waves-effect waves-light btn-block  mt-2">Crop</button>
                          </form>
                    </div>
                </div><!--end if -->
                <div v-if="getImg != 'photo'">
                   <img v-if="getImg" :src="'/uploads/avaters/'+getImg" alt="avater" class="img-fluid">
                    <button type="button" v-if="getImg "  class="btn btn-outline-success waves-effect waves-light btn-block  mt-3" @click="newUpload">Upload New Photo</button>
                    <button type="button" v-if="!getImg" class="btn btn-outline-danger waves-effect waves-light btn-block  mt-3" @click="calcelUpload">Cancel</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import VueAvatar from '../vue-avater-editor/src/components/VueAvatar.vue'
import VueAvatarScale from '../vue-avater-editor/src/components/VueAvatarScale.vue'
 export default {
  components: {
    VueAvatar,
    VueAvatarScale
  },
  props: ['admin_id'],
    data(){
        return{   
            image: {
                photo: '',
                user_id: ''
            },
            getImg : '',
            croped: false,
            oldImage: null,  
        }
    },
    computed: {
            Admin_id() {
                return this.admin_id
            }
        },
  methods:{
    onChangeScale (scale) {
        this.$refs.vueavatar.changeScale(scale)
    },
    saveClicked(){
        let vm = this;
        var img = this.$refs.vueavatar.getImageScaled()
        this.image.photo = img.toDataURL();  
        this.image.user_id = this.Admin_id;  
        this.croped = true;
    },
    onImageReady(scale){
        this.$refs.vueavatarscale.setScale(scale)
    },
    Cancel(){
        this.croped = false;
        this.oldImage = this.image.photo;
    },
    Upload(){
            let vm = this;
            let url = "/admin/upload";
            axios.post(url, this.image).then(res=>{
                    this.$toasted.error(res.data.errors).goAway(8000);
                    this.$toasted.success(res.data.success).goAway(8000);
            })
        },
    getImage(){
          let vm = this;
            let url = "/admin/getimg/" + this.Admin_id;
            axios.get(url).then(res=>{
             this.getImg = res.data.photo; 
            })
    },
    newUpload(){
        this.getImg = false;
    },
    calcelUpload(){
        this.getImg = true;
        this.getImage();
    }
    }, 
    created(){
        this.getImage();
    }
 }

</script>

