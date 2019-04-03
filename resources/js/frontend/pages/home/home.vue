<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3 style="z-index: 999;">
      <div class="avater_name glitch-effect" :data-text="mainText">{{ mainText }}</div>
      <div class="avater_img" v-if="photo">
        <img :src="'uploads/generals/' + photo" alt="avatar">
      </div>
      <div class="vue_type_js">
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
      <div class="contact_button">
        <div class="trapdoor">
          <div class="top door"></div>
          <div class="bottom door"></div>
          <a
            href="#"
            class="twitter-follow-button"
            data-show-count="false"
            data-size="large"
            data-dnt="false"
          >@send quote</a>
        </div>
      </div>
    </v-flex>
    <particles/>
  </v-layout>
</template>

<script>
import particles from "../../components/particles/particles";

export default {
  components: {
    particles
  },
  data() {
    return {
      TextAnimation: [],
      mainText: "",
      logo: "",
      photo: ""
    };
  },
  methods: {
    getHomeData() {
      let vm = this;
      let url = "home/text";
      axios.get(url).then(res => {
        vm.TextAnimation = res.data.animate_text;
        vm.logo = res.data.logo;
        vm.photo = res.data.photo;
        vm.mainText = res.data.main_text;
      });
    }
  },
  created() {
    this.getHomeData();
    document.title = "Personal Portfolio";
  }
};
</script>
<style lang="scss">
.avater_img {
  text-align: center;
}
.avater_img > img {
  width: 200px;
  border-radius: 100px;
  box-shadow: 0 8px 18px 0px #8d8d8e;
}
.vue_type_js {
  display: flex;
  justify-content: center;
  padding-top: 1rem;
}
.vue_type_js span {
  font-size: 40px;
  text-transform: uppercase;
  font-family: "Chewy", cursive;
  color: #004d40 !important;
}
.vue_typer {
  display: block;
}
.avater_name {
  font-size: 70px !important;
  text-transform: uppercase;
  color: #f50057;
  text-align: center;
  font-family: "Black Ops One", cursive;
  padding-bottom: 15px;
  text-shadow: 1px 2px 8px #000;
}
/* Glitch Animations */

.glitch-effect {
  position: relative;
}

.glitch-effect:before,
.glitch-effect:after {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  background: transparent;
  clip: rect(0, 0, 0, 0);
}

.glitch-effect:after {
  left: 2px;
  text-shadow: -1px 0 rgb(93, 233, 37);
  animation: glitch-1 2s infinite linear alternate-reverse;
}

.glitch-effect:before {
  left: -2px;
  text-shadow: 2px 0 rgba(233, 236, 41, 0.733);
  animation: glitch-2 2s infinite linear alternate-reverse;
}

@keyframes glitch-1 {
  0% {
    clip: rect(20px, 920px, 51px, 0);
  }

  5% {
    clip: rect(83px, 920px, 102px, 0);
  }

  10% {
    clip: rect(83px, 920px, 105px, 0);
  }

  15% {
    clip: rect(95px, 920px, 11px, 0);
  }

  20% {
    clip: rect(105px, 920px, 56px, 0);
  }

  25% {
    clip: rect(40px, 920px, 19px, 0);
  }

  30% {
    clip: rect(56px, 920px, 97px, 0);
  }

  35% {
    clip: rect(9px, 920px, 17px, 0);
  }

  40% {
    clip: rect(103px, 920px, 53px, 0);
  }

  45% {
    clip: rect(92px, 920px, 6px, 0);
  }

  50% {
    clip: rect(69px, 920px, 46px, 0);
  }

  55% {
    clip: rect(8px, 920px, 87px, 0);
  }

  60% {
    clip: rect(12px, 920px, 15px, 0);
  }

  70% {
    clip: rect(28px, 920px, 106px, 0);
  }

  80% {
    clip: rect(98px, 920px, 63px, 0);
  }

  85% {
    clip: rect(11px, 920px, 44px, 0);
  }

  95% {
    clip: rect(23px, 920px, 84px, 0);
  }

  100% {
    clip: rect(66px, 920px, 91px, 0);
  }
}

@keyframes glitch-2 {
  0% {
    clip: rect(86px, 920px, 25px, 0);
  }

  5% {
    clip: rect(30px, 920px, 17px, 0);
  }

  10% {
    clip: rect(54px, 920px, 43px, 0);
  }

  15% {
    clip: rect(10px, 920px, 86px, 0);
  }

  25% {
    clip: rect(62px, 920px, 1px, 0);
  }

  30% {
    clip: rect(61px, 920px, 24px, 0);
  }

  35% {
    clip: rect(38px, 920px, 46px, 0);
  }

  40% {
    clip: rect(115px, 920px, 8px, 0);
  }

  45% {
    clip: rect(87px, 920px, 44px, 0);
  }

  50% {
    clip: rect(6px, 920px, 65px, 0);
  }

  55% {
    clip: rect(83px, 920px, 99px, 0);
  }

  65% {
    clip: rect(25px, 920px, 71px, 0);
  }

  70% {
    clip: rect(37px, 920px, 55px, 0);
  }

  75% {
    clip: rect(115px, 920px, 18px, 0);
  }

  80% {
    clip: rect(68px, 920px, 46px, 0);
  }

  90% {
    clip: rect(47px, 920px, 31px, 0);
  }

  95% {
    clip: rect(47px, 920px, 84px, 0);
  }

  100% {
    clip: rect(93px, 920px, 53px, 0);
  }
}

/* Mouse Button Animations */
@keyframes mouse-anim {
  0% {
    top: 0px;
  }

  50% {
    top: 10px;
  }

  100% {
    top: 0px;
  }
}
.contact_button {
  width: 100%;
  display: flex;
  justify-content: center;
  padding-top: 20px;
}
.trapdoor {
  -webkit-transform: translateZ(0px);
  -webkit-font-smoothing: antialiased;
  width: 200px;
  height: 50px;
  box-shadow: inset -7px 0px 12px -8px rgba(0, 0, 0, 0.3),
    inset 7px 0px 12px -8px rgba(0, 0, 0, 0.3);
  background: rgba(0, 0, 0, 0.3);
  -webkit-transition: background 400ms ease-in-out;
  -moz-transition: background 400ms ease-in-out;
  -ms-transition: background 400ms ease-in-out;
  -o-transition: background 400ms ease-in-out;
  transition: background 400ms ease-in-out;

  &:hover {
    background: #fafafa;

    .door {
      box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.4);
      -webkit-transform: scale(1.08);
      -moz-transform: scale(1.08);
      -ms-transform: scale(1.08);
      -o-transform: scale(1.08);
      transform: scale(1.08);
    }

    .top {
      top: -50%;
    }

    .bottom {
      top: 100%;
    }
  }

  .twitter-follow-button {
    position: absolute !important;
    margin-top: -15px;
    left: 50%;
    top: 50%;
    margin-left: -55px;
    font-size: 18px;
    color: #f50057;
  }
}

.top {
  top: 0%;
  left: 0px;

  &:before {
    top: 5px;
  }
}

.bottom {
  top: 50%;
  left: 0px;

  &:before {
    top: -20px;
  }
}

.door {
  -webkit-transition: top 400ms, box-shadow 200ms, -webkit-transform 300ms;
  -moz-transition: top 400ms, box-shadow 200ms, -moz-transform 300ms;
  -ms-transition: top 400ms, box-shadow 200ms, -ms-transform 300ms;
  -o-transition: top 400ms, box-shadow 200ms, -o-transform 300ms;
  transition: top 400ms, box-shadow 200ms, transform 300ms;
  -webkit-transition-timing-function: ease-in-out;
  -moz-transition-timing-function: ease-in-out;
  -ms-transition-timing-function: ease-in-out;
  -o-transition-timing-function: ease-in-out;
  transition-timing-function: ease-in-out;
  background-color: #fafafa;
  position: absolute;
  overflow: hidden;
  width: 100%;
  z-index: 2;
  height: 50%;

  &:before {
    font-family: "Material Icons";
    content: "\e0d0";
    position: absolute;
    margin-left: -20px;
    font-size: 35px;
    display: block;
    color: #f50057;
    width: 0px;
    height: 20px;
    left: 52%;
  }
}
@media only screen and (max-width: 600px) {
  .avater_name {
    font-size: 40px !important;
  }
}
@media only screen and (min-width: 1264px) {
  .avater_name {
    font-size: 100px !important;
  }
}
</style>