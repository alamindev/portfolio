<template>
  <v-footer class="footer">
    <div class="copyright">@{{ copyright }} {{ getFooter }}</div>
    <div class="social-icon">
      <ul class="icon">
        <li v-for="social in socials" v-bind:key="social.id">
          <a
            :href="social.link"
            :style="{
                background: hovers.hover_back == social.hover_background ? hovers.hover_back : social.background,
                color: hovers.hover_color == social.hover_color ? hovers.hover_color : social.color, 
              }"
            @mouseenter="HoverSettingEnter(social.id, social.hover_background, social.hover_color)"
            @mouseleave="HoverSettingLeave(social.id, social.hover_background, social.hover_color)"
            target="_blank"
          >
            <i :class="social.icon" :style="{    fontSize: social.font_size + 'px' }"></i>
          </a>
        </li>
      </ul>
    </div>
  </v-footer>
</template>
<script>
export default {
  name: "footers",
  props: ["getFooter"],
  data() {
    return {
      copyright: new Date().getFullYear(),
      socials: [],
      hovers: {
        hover_back: "",
        hover_color: ""
      }
    };
  },
  methods: {
    Footer() {
      let vm = this;
      let url = "/api/footer/";
      axios.get(url).then(res => {
        this.socials = res.data;
      });
    },
    HoverSettingEnter(id, value1, value2) {
      if (id) {
        this.hovers.hover_back = value1;
        this.hovers.hover_color = value2;
      }
    },
    HoverSettingLeave(id, value1, value2) {
      if (id) {
        this.hovers.hover_back = "";
        this.hovers.hover_color = "";
      }
    }
  },
  created() {
    this.Footer();
  }
};
</script>
<style lang="scss">
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  z-index: 9999;
  background: transparent !important;
  padding: 5px 0;
}
.copyright {
  width: 50%;
}

.social-icon {
  margin: 0;
  padding: 0;
  width: 50%;
  .icon {
    display: flex;
    justify-content: flex-end;
    list-style: none;
    margin: 0;
    padding: 0;
    li {
      a {
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        line-height: 0;
      }
    }
  }
}
@media only screen and (max-width: 600px) {
  .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 9999;
    flex-direction: column;
    height: auto !important;
    background: #f5f5f5;
  }
  .copyright {
    width: 100%;
    text-align: center;
  }
  .social-icon {
    margin: 0;
    padding: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 0;
  }
}
</style>
