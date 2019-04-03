<template>
 <v-footer class="pa-3 footer"> 
      <div class="copyright">@{{ copyright }} {{ getFooter }}</div>
    <div class="social-icon">
        <ul class="icon">
            <li><a href=""><i class="fab fa-facebook"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
        </ul>
    </div>
</v-footer>
</template>
<script>
export default {
  name: "footers",
props: ['getFooter'],
  data() {
    return {
      copyright: new Date().getFullYear(),
    };
  },
  methods: {
    
  }
};
</script>
<style lang="scss">
.footer{
  position: absolute;
  bottom: 0;
  width: 100%;
}
.copyright{
    width: 50%
}
.social-icon{
    margin: 0;
    padding: 0;
    width: 50%;
    .icon{
        display: flex;
        justify-content: flex-end;
        list-style: none; 
        margin: 0;
        padding: 0;
        li{
            padding: 5px;
            a{
                text-decoration: none;
                display: block;
                i{
                    color: red;
                    font-size: 18px;
                }
            }
        }
    }
}
</style>
