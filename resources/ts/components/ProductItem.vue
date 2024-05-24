<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    name: "ProductItem",
    props: ['product']
})
</script>

<template>
    <a class="group flex flex-col hover:shadow-md transition product" href="#">
        <div class="p-2 pr-1 md:p-3 md:pr-2 relative">
            <span class="absolute -top-2.5 end-2 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white">{{ product.price }} ₽</span>
            <div class="flex justify-between items-center">
                <div class="pe-1">
                    <img class="size-[40px] object-cover" :src="product.image" :alt="product.name">
                </div>
                <div>
                    <span class="text-white text-sm font-semibold">
                        {{ product.name }}
                    </span>
                    <p class="text-sm text-gray-100 hidden">
                        {{ product.description }}
                    </p>
                </div>
                <div class="ps-1">
                    <img src="https://minecraft-theme.netlify.app/imgs/icons/large-arrow-right.png" class="flex-shrink-0 size-2.5 object-contain m-[1rem] [transform:scale(2)]">
                    <svg class="hidden flex-shrink-0 size-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </div>
            </div>
        </div>
    </a>
</template>

<style scoped>
/*bg-gradient-to-r from-cyan-500 to-blue-500*/

    .product {
        --zoom: 4;
        --block-size: 48px;
        box-sizing: content-box;
        border-width: calc(var(--block-size) / var(--zoom));
        border-image: url('https://minecraft-theme.netlify.app/imgs/ui/map.png');
        border-image-width: calc(var(--block-size) / var(--zoom));
        border-image-slice: 12.75% 15.75% fill;
        border-image-repeat: repeat;
    }
</style>
