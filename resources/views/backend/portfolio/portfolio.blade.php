@extends('backend.layouts.app')
@section('title')
Portfolio Category Information
@endsection 
@section('main-content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body p-2 d-md-flex d-sm-block justify-content-between align-items-center text-center">
            <h4 class="text-capitalize m-0"><i class="fas fa-first-aid"></i>portfolio Category Information</h4> 
                    <button type="button" @click="ModalShow" class="btn btn-outline-success waves-effect waves-light"><i class="fa fa-plus"></i> &nbsp; add</span></button>
            </div>
        </div>
    </div>
</div> 
<div class="row mt-2">
    <div class="col-xs-12 col-md-12 col-lg-8 col-xl-8 offset-lg-2"> 
             <div class="card m-t-30">
            <div class="card-body p-2">
              <transition name="fade">
              <div class="alert alert-success" id="success" v-if="success" v-cloak>
                <strong>Success!</strong> <span class="text-primary" v-cloak> @{{ success  }}</span>
              </div>
              </transition>
              <table class="table table-inverse table-bordered" >
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody v-for="(category,index) in categories" :key="index" v-cloak>
                  <tr>
                    <td v-cloak>@{{ index }}</td>
                    <td v-if="!showform(category.id)" v-cloak>@{{ category.portfolio_name }}</td>
                    <td  v-if="showform(category.id)" v-cloak><input type="text" class="form-control" v-model="category.portfolio_name" v-cloak></td>
                    <td> 
                <button v-if="!showform(category.id)" @click="editing(category.id)" class="btn btn-twitter waves-effect waves-light btn-sm"><i class="fa fa-edit"></i></button>      
                <button v-if="!showform(category.id)" @click="deleted(category.id)" class="btn btn-dropbox waves-effect waves-light btn-sm"><i class="fa fa-trash"></i></button>    
                <button type="submit" v-if="showform(category.id)" @click="updateData(category.id)" class="btn btn-tumblr waves-effect waves-light btn-sm">Save</button>
                <button v-if="showform(category.id)" @click="cancel(category.id)" class="btn btn-flickr waves-effect waves-light btn-sm">cancel</button>
             </td>
          </tr>
      </tbody>
      </table> 
    </div>
    <!--end card body--> 
  </div>
    </div>   
</div> 
<!-- end row -->

<!--===========================================
    coding for modal
  ============================================--> 
<div  class="modal fade" v-bind:class="showModal" id="permission_table1" :style="displayModal" aria-labelledby="mySmallModalLabel"  aria-hidden="true" aria-model="true" >
        <div class="modal-dialog" role="document"> 
         <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">Add New Portfolio Category</h5>
                      <button type="button" class="close" @click="closeModal">
                          <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body" > 
               <form @submit.prevent="submitForm">
                    <div class="form-group">
                      <label for="name">Category Name</label>
                      <input type="text" class="form-control" name="portfolio_name" placeholder="category name" v-model="category.portfolio_name">
                      <span class="text-danger">@{{ errors.portfolio_name ? errors.portfolio_name[0] : "" }}</span>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-outline-secondary btn-rounded waves-effect">Save changes</button>
                      <button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light" @click="closeModal">Cancel</button>
                    </div>
                  </form>
                </div> 
            </div>
        </div>
    </div>
 
@endsection
@section('scripts') 
 <script type="text/javascript">
  var app = new Vue({
      el: '#app',
      data: {
        showModal: false,
        displayModal: 'display: block; opacity: 0; visibility: hidden',
        errors: {},
        category: {
          portfolio_name: ''
        },
        success: '',
        isLoding: false,
        categories: [],
        editform: ''
      },
      methods: {
        ModalShow(){
          this.showModal = 'show'; 
          this.displayModal = 'display:block; opacity: 1; visibility: visible;   background: rgba(0,0,0,.5);'; 
        },
        closeModal(){
          this.showModal = '';
          this.displayModal = 'display: block; opacity: 0; visibility: hidden';
           this.category = {
            portfolio_name: ''
          };
          if(this.showModal == false){
            this.errors=false;
          }
        },
        submitForm(){
          let url = "portfolios";
          let vm = this;
          axios.post(url,this.category).then(res => { 
            this.category = { portfolio_name: '' }; 
            this.errors= false;
          this.showModal = '';
          this.displayModal = 'display: block; opacity: 0; visibility: hidden';
            this.success = res.data.message;  
            console.log(res.data.message)
            this.fetchData();
              var v = this;
              setTimeout(function () {
                v.success = false;
               }, 3000);
          }).catch(error => {
              this.errors = error.response.data.errors 
          });
        },
         //fetch data query
        fetchData() {
          this.loading = true;
          let url = "portfolios/all";
          let vm = this;
          axios.get(url).then(res => {
            vm.categories = res.data;
            this.loading = false; 
          });
        },
        showform(id){
           if(this.editform == id){
             return true;
           }
           return false;
        },
        editing(id){
            this.categories.forEach((data,i)=>{
            if(data.id  == id){
              this.category = data
            }
          }); 
          return this.editform = id; 
        },
        cancel(id){
          this.editform = false;
          this.category = {
            portfolio_name: ''
          }
        },
         updateData(id) {
          let input = this.category;
          let url = "portfolios/" + id;
          axios.put(url, input).then(res => {
            this.editform = false; 
            this.category = { portfolio_name: '' }; 
            this.$toasted.success(res.data.message).goAway(8000);
          }).catch(error=>{ 
            this.$toasted.error(error.response.data.errors.portfolio_name[0]).goAway(8000); 
          });
        },
        deleted(id) {
          let ok = confirm('are you sure');
          if(ok){
          let input = this.category;
          let url = "portfolios/" + id;
          axios.delete(url, input).then(res => {
            this.fetchData(); 
             this.$toasted.error(res.data.deleted).goAway(8000);
          });
        } 
      },
          
      },//end methods
      created(){
        this.fetchData();
      }
    });

</script>
@endsection
