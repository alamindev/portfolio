<template>
  <v-app id="inspire">
    <navs :getLogo="{logo: items.logo, mainText: items.main_text }"></navs> 
    <v-content>
      <v-container fluid grid-list-md>
        <transition name="fade" mode="out-in">
          <router-view></router-view>
        </transition>
      </v-container> 
    </v-content>
    <footers :getFooter="items.copy_right"></footers>
  </v-app>
</template>

<script>
import navs from "../layouts/nav.vue";
import footers from "../layouts/footer.vue";
export default {
  components: {
    navs,footers
  },
  data(){
    return{
      items: {},
    }
  },
  methods: {
      getItems(){
          let vm = this;
              let url = '/api/header-footer/';
              axios.get(url).then(res=>{
                this.items = res.data;  
              });
      }
  },
  created(){
    this.getItems()
  }
};
</script>
<style lang="scss">
@media only screen and (min-width: 991px) {
  html {
    overflow: hidden;
  }
}

.v-toolbar {
  z-index: 999;
  background: #fff !important;
  box-shadow: 0 9px 9px -6px #13131340;
}
.v-menu__content .v-list__tile__title {
  height: auto;
}
.v-menu__content .v-list__tile {
  margin: 0;
  padding: 0;
}
.v-menu__content .v-btn--router {
  width: 100%;
  margin: 0;
  padding: 20px;
}
.v-menu__content .v-list {
  background: #fff;
  color: rgba(0, 0, 0, 0.87);
  width: 250px;
  padding: 15px;
}
.router-link-active {
  color: red;
}

.fade-enter {
  opacity: 0;
}

.fade-enter-active {
  transition: opacity 0.5s ease;
}

.fade-leave-active {
  transition: opacity 0.5s ease;
  opacity: 0;
}
.v-toolbar__title img {
  width: 100px;
  padding-top: 10px;
}
</style>