<template>
  <v-toolbar>
    <v-toolbar-title> 
      <img  v-if="getLogo.logo" :src="`/uploads/generals/${getLogo.logo}`"  :alt=" getLogo.mainText">
      <h4 v-if="!getLogo.logo">{{ getLogo.mainText }}</h4>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
      <v-btn
        v-for="item in menu"
        :key="item.icon"
        :to="item.link"
        flat
        color="success"
      >{{ item.title }}</v-btn>
    </v-toolbar-items>

    <v-menu class="hidden-md-and-up">
      <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>
      <v-list>
        <v-list-tile v-for="item in menu" :key="item.icon">
          <v-list-tile-content>
            <v-list-tile-title>
              <v-btn color="success" flat :to="item.link">{{ item.title }}</v-btn>
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>
<script>
export default {
  name: "navs",
  props: {
    getLogo: Object
  },
  data() {
    return {
      menu: [
        { icon: "home", title: "Home", link: "/home" },
        { icon: "portfolio", title: "Portfolio", link: "/home/portfolio" },
        { icon: "contact", title: "Contact", link: "/home/contact" }
      ]
    };
  },
  methods: {
    menuItems() {
      return this.menu;
    }
  }
};
</script>