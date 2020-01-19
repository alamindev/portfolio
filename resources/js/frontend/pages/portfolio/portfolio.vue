<template>
  <v-layout row wrap>
    <v-flex xs12 sm2>
      <div class="list" v-animate-css="'slideInLeft'">
        <div class="responsive_icon">
          <i class="fas fa-braille"></i>
        </div>
        <ul class="list-main" id="category_list_item">
          <li>
            <a href="#" class="all_item" @click.prevent="allItem" :class="allItemActive">All Item</a>
          </li>
          <li v-for="category in PortCategory" :key="category.id">
            <a
              href="#"
              @click.prevent="getItemById(category.id)"
              :class="ActiveIfRight(category.id)"
            >{{ category.portfolio_name }}</a>
          </li>
        </ul>
      </div>
    </v-flex>
    <v-flex xs12 sm10 style="z-index: 999;">
      <VuePerfectScrollbar class="portfolio-main" :settings="settings">
        <div class="portfolio-item">
          <v-layout row wrap v-if="allPort">
            <v-flex xs12 sm4 v-for="item in AllItem" v-bind:key="item.id" style="padding: 12px">
              <v-card v-animate-css="'flipInX'">
                <div class="main-img">
                  <div class="overlay-img">
                    <div class="custom-btn">
                      <v-btn color="light" dark @click.prevent="ShowDetails(item.id)">Show More</v-btn>
                    </div>
                    <v-img
                      v-if="item.sub_port_photo"
                      :src="`/uploads/portfolio/${item.sub_port_photo}`"
                      :lazy-src="`/uploads/portfolio/${item.sub_port_photo}`"
                      aspect-ratio="1.5"
                      class="grey lighten-2"
                    ></v-img>
                  </div>
                  <div class="title">
                    <h4 class="headline mb-0">{{ item.sub_port_name }}</h4>
                  </div>
                </div>
              </v-card>
            </v-flex>
          </v-layout>
          <v-layout row wrap v-if="allPort == false">
            <v-flex
              xs12
              sm4
              v-for="itemid in ItemById"
              v-bind:key="itemid.id"
              style="padding: 12px"
            >
              <v-card v-animate-css="'flipInY'">
                <div class="main-img">
                  <div class="overlay-img">
                    <div class="custom-btn">
                      <v-btn color="light" dark @click.prevent="ShowDetails(itemid.id)">Show More</v-btn>
                    </div>
                    <v-img
                      v-if="itemid.sub_port_photo"
                      :src="`/uploads/portfolio/${itemid.sub_port_photo}`"
                      :lazy-src="`/uploads/portfolio/${itemid.sub_port_photo}`"
                      aspect-ratio="1.5"
                      class="grey lighten-2"
                    ></v-img>
                  </div>
                  <div class="title">
                    <h4 class="headline mb-0">{{ itemid.sub_port_name }}</h4>
                  </div>
                </div>
              </v-card>
            </v-flex>
          </v-layout>
        </div>
      </VuePerfectScrollbar>
      <v-layout row justify-center>
        <v-dialog v-model="dialog" max-width="800">
          <v-card>
            <v-img
              v-if="showDetail.sub_port_photo"
              :src="`/uploads/portfolio/${showDetail.sub_port_photo}`"
              :lazy-src="`/uploads/portfolio/${showDetail.sub_port_photo}`"
              aspect-ratio="3"
              class="grey lighten-2"
            >
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <span
                      class="headline category-portfolio"
                    >{{ showCategoryDetails.portfolio_name}}</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-img>
            <v-card-text>
              <div class="goto_link">
                <a :href="showDetail.sub_port_link" target="_blank">Goto Live</a>
              </div>
              <v-card-title primary-title>
                <div>
                  <h2 class="headline mb-2">{{ showDetail.sub_port_name }}</h2>
                  <div v-html=" showDetail.sub_port_details "></div>
                </div>
              </v-card-title>
            </v-card-text>
            <v-card-actions style="display: flex; justify-content: flex-end">
              <v-btn flat color="red" @click.stop="dialog = false">close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
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
      dialog: false,
      settings: {
        maxScrollbarLength: 95
      },
      PortCategory: [], // for api/category route
      allItemActive: false,
      AllItem: [],
      ItemById: [],
      itemIdForActive: {},
      allPort: true,
      showDetail: false,
      showCategoryDetails: {},
      windowWidth: null
    };
  },
  methods: {
    /*
     * @route api/categtory
     * return  portfolio category
     */
    getCategory() {
      let vm = this;
      let url = "/api/category";
      axios.get(url).then(res => {
        vm.PortCategory = res.data;
      });
    },
    allItem() {
      this.$Progress.start();
      let vm = this;
      let url = "/api/all-portfolio";
      axios.get(url).then(res => {
        this.AllItem = res.data;
        this.allItemActive = "active";
        this.allPort = true;
        let id = document.getElementById("dev__responsive_category");
        id.style.left = "-245px";
        id.style.opacity = "0";
        this.$Progress.finish();
      });
    },
    getItemById(id) {
      this.$Progress.start();
      let vm = this;
      let url = "/api/portfolio/" + id;
      axios.get(url).then(res => {
        this.$Progress.finish();
        this.ItemById = res.data.sub_portfolios;
        this.itemIdForActive = res.data.id;
        this.allPort = false;
        this.allItemActive = false;
        let id = document.getElementById("dev__responsive_category");
        id.style.left = "-245px";
        id.style.opacity = "0";
      });
    },
    ActiveIfRight(id) {
      if (this.allItemActive == false) {
        if (id === this.itemIdForActive) {
          return "is-active";
        }
      }
    },
    ShowDetails(id) {
      this.$Progress.start();
      let vm = this;
      let url = "/api/sub-portfolio/" + id;
      axios.get(url).then(res => {
        this.showDetail = res.data;
        this.showCategoryDetails = res.data.portfolios;
        this.dialog = true;
        this.$Progress.finish();
      });
    },
    sideNavShow() {
      let id = document.getElementById("category_list_item");
      id.style.left = "0";
      id.style.opacity = "1";
    },
    handleResize() {
      this.windowWidth = window.innerWidth;
      if (this.windowWidth <= 600) {
        setTimeout(() => {
          let classList = document.getElementById("category_list_item")
            .classList;
          classList.add("dev__responsive_category");
          classList.remove("list-main");
          document.querySelector(".list").style.backgroundColor = "transparent";
          document.querySelector(".list").style.padding = "0";
          let responsive_icon = document.querySelector(".responsive_icon i");
          responsive_icon.style.display = "inline-block";
          responsive_icon.addEventListener("click", this.sideNavShow);
          let body = document.querySelector("#app");
          let wrapper = document.querySelector(".dev__responsive_category");
          body.addEventListener(
            "click",
            function() {
              let id = document.getElementById("category_list_item");
              id.style.left = "-245px";
              id.style.opacity = "0";
            },
            false
          );
          wrapper.addEventListener(
            "click",
            function(ev) {
              ev.stopPropagation();
            },
            false
          );
          responsive_icon.addEventListener(
            "click",
            function(ev) {
              ev.stopPropagation();
            },
            false
          );
        }, 100);
      } else {
        setTimeout(() => {
          let classList = document.getElementById("category_list_item")
            .classList;
          classList.add("list-main");
          classList.remove("dev__responsive_category");
          let responsive_icon = document.querySelector(".responsive_icon i");
          responsive_icon.style.display = "none";
        }, 100);
      }
    }
  },
  created() {
    document.title = "Al-amin - portfolio";
    this.getCategory();
    this.allItem();

    // show view port width
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
  }
};
</script>
<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Lobster");
.category-portfolio {
  background: #4b73ff none repeat scroll 0% 0%;
  padding: 5px 50px;
  color: white;
  box-shadow: 0px 9px 13px 0px #5653cf;
  display: inline-block;
  border-radius: 0px 86px 5px 0px;
}
.goto_link {
  width: 100%;
  text-align: right;
  a {
    background: #fb435d;
    color: #fff;
    padding: 10px 35px;
    text-decoration: none;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    box-shadow: 0 8px 14px -3px #ff7373;
    border-radius: 20px 0px 20px 1px;
    &:hover {
      background: rgb(255, 41, 25);
      color: #fff;
    }
  }
}
.list {
  padding: 10px;
  background: #fff;
  box-shadow: 5px 11px 26px -3px #d6d6d642;
  height: 85vh;
  .list-main {
    list-style-type: none;
    margin: 0;
    padding: 0;
    .all_item {
      background: #3399ff;
      color: white;
      &:hover {
        background: rgb(46, 112, 255) !important;
        color: white !important;
      }
    }
    .is-active {
      background: #0081ff;
      color: white;
      &:hover {
        background: rgb(46, 112, 255);
        box-shadow: 0px 9px 14px -6px #307df1;
      }
    }
    li {
      border-bottom: 1px solid #efefef;
      &:last-child {
        border-bottom: none;
      }
      a {
        text-decoration: none;
        display: block;
        padding: 10px 20px;
        font-size: 16px;
        color: #000;
        &:not(.is-active) {
          &:hover {
            background: rgb(255, 255, 255);
            color: rgb(39, 39, 39);
            box-shadow: 0px 8px 15px -4px rgb(211, 211, 211);
          }
        }
      }
    }
  }
}
.portfolio-main {
  position: relative;
  margin-top: 10px;
  width: 100%;
  height: 76vh;
  padding-right: 20px;
  padding-left: 15px;
  .portfolio-item {
    .main-img {
      padding: 10px;
      .title {
        text-align: center;
        padding: 5px;
        h4 {
          font-family: "Lobster", cursive !important;
          font-size: 22px !important;
          font-weight: bold;
        }
      }
      .overlay-img {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        &::before {
          content: "";
          position: absolute;
          width: 100%;
          height: 100%;
          background: #0a9266b5;
          left: 0;
          right: 0;
          z-index: 999;
          transform: skewY(300deg);
          opacity: 0;
          transition: 0.3s all;
        }
        .custom-btn {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-100%, -100%);
          z-index: 999999;
          opacity: 0;
          transition: 0.5s all;
        }
      }
      &:hover .overlay-img::before {
        opacity: 1;
        transform: skewY(0deg);
      }
      .v-responsive.v-image {
        transition: 0.5s all;
      }
      &:hover .v-responsive.v-image {
        transform: scale(1.5);
      }
      &:hover .overlay-img .custom-btn {
        opacity: 1;
        transform: translate(-50%, -50%);
      }
    }
  }
}
.modal {
  position: fixed;
  left: 0;
  top: 0;
  background: red;
  width: 100%;
  height: 100%;
  z-index: 999999;
}
.isActive {
  background: #ecececa3;
}
@media only screen and (max-width: 600px) {
 
  .v-content__wrap {
      margin-bottom: 35px;
    } 
  .portfolio-main {
    position: relative;
    margin-top: 0;
    margin-bottom: 0;
    height: 72vh;
  }
  .list {
    height: auto;
  }
  .list .list-main {
    list-style-type: none;
    margin: 0;
    padding: 0px 12px 0px 4px;
  }
}
.dev__responsive_category {
  position: absolute;
  left: -245px;
  opacity: 0;
  top: 0;
  margin: 0;
  padding: 0;
  width: 240px;
  height: 100%;
  z-index: 9999;
  display: flex;
  flex-direction: column;
  background: rgba(253, 253, 253, 0.8);
  box-shadow: 5px 2px 4px -5px #9b9b9b;
  list-style: none;
  transition: 0.5s all ease;
  .all_item {
    background: #3399ff;
    color: white;
    &:hover {
      background: rgb(46, 112, 255) !important;
      color: white !important;
    }
  }
  .is-active {
    background: #0081ff;
    color: white;
    &:hover {
      background: rgb(46, 112, 255);
      box-shadow: 0px 9px 14px -6px #307df1;
    }
  }
  li {
    border-bottom: 1px solid #efefef;
    &:last-child {
      border-bottom: none;
    }
    a {
      text-decoration: none;
      display: block;
      padding: 10px 20px;
      font-size: 16px;
      color: #000;
      &:not(.is-active) {
        &:hover {
          background: rgb(255, 255, 255);
          color: rgb(39, 39, 39);
          box-shadow: 0px 8px 15px -4px rgb(211, 211, 211);
        }
      }
    }
  }
}
.responsive_icon {
  i {
    font-size: 25px;
    padding: 8px 13px;
    color: #ff4747;
    cursor: pointer;
    display: inline-block;
  }
}
</style>