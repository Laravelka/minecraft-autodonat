<script>
import {defineComponent} from 'vue'
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
import Alert from "@/components/Alert.vue";

export default defineComponent({
    name: "App",
    components: {Alert, Footer, Navbar}
})
</script>

<template>
    <Navbar />
    <div class="p-2">
        <Alert />
        <router-view></router-view>
    </div>
    <Footer />
</template>
<style scoped>

</style>
