<template>
  <div>
    <v-layout row wrap>
      <v-flex xs12 sm12>
        <div class="heading-title">
          <h1 class="about-head">About Me</h1>
          <p class="main-info">Information About Me</p>
        </div>
      </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex xs12 sm5>
        <div class="about-image-main">
          <parallax-container class="horizontal-card centered-card">
            <parallax-element class="text-container" :parallaxStrength="-5" :type="'depth'">
              <div class="about-image">
                <img
                  class="about-img"
                  src="http://alamindevbd.com/public/uploads/photo.jpg"
                  alt="about image"
                />
                <img
                  class="about-img-two"
                  src="http://alamindevbd.com/public/uploads/photo.jpg"
                  alt="about image"
                />
                <span class="about-border"></span>
              </div>
            </parallax-element>
          </parallax-container>
        </div>
      </v-flex>
      <v-flex xs12 sm7>
        <div class="about-details-main">
          <div class="about-details-area">
            <div class="animated-text-area">
              <h1 class="about-heading">I'm Al-amin and</h1>
              <vue-typer
                :text="TextAnimation"
                :repeat="Infinity"
                :shuffle="true"
                initial-action="typing"
                :pre-type-delay="100"
                :type-delay="65"
                :pre-erase-delay="2000"
                :erase-delay="250"
                erase-style="backspace"
                :erase-on-complete="true"
                caret-animation="smooth"
              ></vue-typer>
            </div>
            <p class="about-details">
              Hi! My name is
              <strong>AL-Amin</strong>.
              <strong>I am a Web Developer</strong>, and I'm very passionate and dedicated to my work. With 3 years experience as a professional Web developer, I have acquired the skills and knowledge necessary to make your project a success. I enjoy every step of the design and Development process, from discussion and collaboration to concept and execution, but I find the most satisfaction in seeing the finished product do everything for you that it was created to do.
            </p>
            <div class="about-list-area">
              <ul class="about-list">
                <li>
                  <span>Name:</span> Al-AMIN
                </li>
                <li>
                  <span>Age:</span> 22
                </li>
                <li>
                  <span>Birthday:</span> 20-11-1996
                </li>
                <li>
                  <span>Residence:</span> Savar, Dhaka
                </li>
                <li>
                  <span>Address:</span> Jamalpur, Dhaka, Bangladesh
                </li>
                <li>
                  <span>Email:</span> mdalamin6554@gmail.com
                </li>
                <li>
                  <span>Phone:</span> +8801823413988
                </li>
                <li>
                  <span>Freelance:</span> Available
                </li>
                <li>
                  <span>Degree:</span> Running
                </li>
                <li>
                  <span>Twitter:</span> @mdalamin_6554
                </li>
              </ul>
            </div>
          </div>
          <div class="button-container"> 
            <a class="btn-style-1" href="https://alamindevbd.com/public/uploads/cv.pdf" download> 
              <span>Download CV</span> 
             </a>
            <router-link class="btn-style-2" to="/home/contact">Send Message</router-link>
          </div>
        </div>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
export default {
  components: {
    VuePerfectScrollbar
  },
  data() {
    return {
      TextAnimation: []
    };
  },
  methods: {
    getHomeData() {
      let vm = this;
      let url = "text";
      axios.get(url).then(res => {
        vm.TextAnimation = res.data.animate_text;
      });
    }
  },
  created() {
    this.getHomeData();
    document.title = "Al-amin - about";
  }
};
</script>
<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Abril+Fatface|Barlow");
.heading-title {
  margin-left: 50px;
  padding-left: 10px;
  position: relative;
  line-height: 30px;
  .about-head {
    font-family: "Abril Fatface", cursive;
    font-size: 32px;
    font-weight: bold;
    text-transform: uppercase;
    margin: 0;
    padding: 0;
    color: #069c2c;
  }
  .main-info {
    font-size: 18px;
    padding: 0;
    margin: 0;
  }
  &::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: #ff4545;
  }
  &::after {
    content: "";
    position: absolute;
    left: 12%;
    bottom: 0;
    width: 100px;
    height: 5px;
    background: #ff4545;
  }
}
.about-image-main {
  margin-left: 50px;
  .about-image {
    position: relative;
    width: 70%;
    .about-img {
      width: 100%;
      height: auto;
      z-index: 999;
    }
    .about-border {
      position: absolute;
      top: 25px !important;
      bottom: -25px !important;
      left: 25px !important;
      right: -25px !important;
      border: 10px solid #ff4545;
    }
    .about-img-two {
      width: 100%;
      position: absolute;
      left: 0;
      top: 0;
      z-index: 999;
    }
  }
}
/*
    
    * Start coding for about area
    
    */
.about-details-main {
  width: 100%;
  display: inline-block;
  .about-details-area {
    margin-right: 50px;
    .animated-text-area {
      display: flex;
      span {
        font-family: "Abril Fatface", cursive;
        font-size: 32px;
        font-weight: bold;
        text-transform: capitalize;
        margin: 0;
        padding: 0;
        color: #ff4545;
      }
    }
    .about-heading {
      font-family: "Abril Fatface", cursive;
      font-size: 32px;
      font-weight: bold;
      text-transform: capitalize;
      margin: 0;
      padding-right: 15px;
      color: #069c2c;
    }
    .about-details {
      padding-top: 15px;
      color: #333;
      font-size: 16px;
      line-height: 1.5;
      font-family: "Barlow", sans-serif;
      strong {
        color: #ff4545;
      }
    }
  }
  .about-list-area {
    display: flex;
    width: 100%;
    height: auto;
    margin-bottom: 13px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    .about-list {
      margin: 0px;
      list-style-type: none;
      li {
        margin: 0px 0px 5px 0px;
        width: 50%;
        float: left;
        font-size: 16px;
        font-family: "Barlow", sans-serif;
        span {
          font-family: "Barlow", sans-serif;
          font-weight: 700;
          font-size: 18px;
          color: #000;
          min-width: 85px;
          display: inline-block;
        }
      }
    }
  }
}
.button-container {
  display: flex;
}
.btn-style-1 {
  border: none;
  display: inline-block;
  text-align: center;
  cursor: pointer;
  text-transform: uppercase;
  outline: none;
  overflow: hidden;
  position: relative;
  color: #fff;
  font-weight: 500;
  font-size: 16px;
  background-color: #24c3cf;
  padding: 10px 30px;
  margin: 0;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  margin-right: 5px;
}

.btn-style-1 span {
  position: relative;
  z-index: 1;
}

.btn-style-1:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 490%;
  width: 140%;
  background: #069c2c;
  -webkit-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-transform: translateX(-98%) translateY(-25%) rotate(45deg);
  transform: translateX(-98%) translateY(-25%) rotate(45deg);
}

.btn-style-1:hover:after {
  -webkit-transform: translateX(-9%) translateY(-25%) rotate(45deg);
  transform: translateX(-9%) translateY(-25%) rotate(45deg);
}
.btn-style-2 {
  margin: 0;
  background: #ff4545;
  color: #fff;
  border: none;
  position: relative;
  height: 45px;
  font-size: 16px;
  padding: 0 30px;
  cursor: pointer;
  transition: 800ms ease all;
  outline: none;
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
}
.btn-style-2:hover {
  background: #fff;
  color: #ff4545;
}
.btn-style-2:before,
.btn-style-2:after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  height: 2px;
  width: 0;
  background: #ff4545;
  transition: 400ms ease all;
}
.btn-style-2:after {
  right: inherit;
  top: inherit;
  left: 0;
  bottom: 0;
}
.btn-style-2:hover:before,
.btn-style-2:hover:after {
  width: 100%;
  transition: 800ms ease all;
}

@media only screen and (max-width: 600px) {
  .heading-title {
    margin-left: 76%;
    transform: translateX(-50%);
    margin-top: 15px;
    width: 100%;
    margin-bottom: 10px;
  }
  .about-details-area {
    margin-top: 50px;
  }
  .about-details-main .about-details-area .about-heading {
    font-size: 24px;
  }
  .about-details-main .about-details-area .animated-text-area span {
    font-size: 22px;
  }
  .about-image-main {
    margin-left: 107px;
  }
  .about-details-main .about-details-area {
    margin-right: 0px;
    padding: 0 30px;
  }
  .about-details-main .about-details-area .animated-text-area {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .button-container {
    display: flex;
    margin-bottom: 100px;
    justify-content: center;
  }
  .about-details-main .about-list-area .about-list {
    margin: 0px;
    list-style-type: none;
    padding-left: 0px;
  }
  .about-details-main .about-list-area .about-list li {
    margin: 0px 0px 5px 0px;
    width: 100%;
    float: left;
    font-size: 16px;
    font-family: "Barlow", sans-serif;
  }
  .about-details-main .about-details-area .about-details {
    text-align: center;
  }
}
@media only screen and (max-width: 400px) {
  .about-image-main {
    margin-left: 60px;
  }
  .about-details-main .about-details-area .about-heading {
    font-size: 22px;
  }
  .about-details-main .about-details-area .animated-text-area span {
    font-size: 20px;
  }
}

@media only screen and (max-width: 991px) {
  .about-details-main .about-details-area .animated-text-area {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .button-container {
    display: flex;
    margin-bottom: 100px;
  }
}
</style>