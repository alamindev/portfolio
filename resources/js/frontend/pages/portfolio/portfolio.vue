<template>
  <v-layout row wrap>
    <v-flex xs12 sm2 style="z-index: 999;">
      <div class="list">
        <ul class="list-main">
          <li>
            <a href="#" class="isActive">new move</a>
          </li>
          <li>
            <a href="#">development</a>
          </li>
        </ul>
      </div>
    </v-flex>
    <v-flex xs12 sm10 style="z-index: 999;">
      <VuePerfectScrollbar class="portfolio-main" :settings="settings">
        <div class="portfolio-item">
          <v-layout row wrap>
            <v-flex xs12 sm4>
              <v-card>
                <div class="main-img">
                  <div class="overlay-img">
                    <div class="custom-btn">
                      <v-btn color="light" dark @click.stop="dialog = true">Show More</v-btn>
                    </div>
                    <v-img
                      src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
                      aspect-ratio="1.5"
                    ></v-img>
                  </div>
                  <div class="title">
                    <h4 class="headline mb-0">Kangaroo Valley Safari</h4>
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
            <v-card-text>Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.</v-card-text>
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
      }
    };
  },
  created() {
    document.title = "Al-amin - portfolio";
  }
};
</script>
<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Lobster");
.list {
  padding: 10px;
  background: #fff;
  box-shadow: 5px 11px 26px -3px #d6d6d642;
  height: 100vh;
  .list-main {
    list-style-type: none;
    margin: 0;
    padding: 0;
    li {
      a {
        text-decoration: none;
        display: block;
        padding: 10px 20px;
        font-size: 16px;
        color: #000;
        &:hover {
          background: rgb(255, 255, 255);
          color: rgb(39, 39, 39);
          box-shadow: 0px 8px 15px -4px rgb(211, 211, 211);
        }
      }
    }
  }
}
.portfolio-main {
  position: relative;
  margin: auto;
  width: 100%;
  height: 100vh;
  padding-top: 8px;
  padding-right: 8px;
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
</style>