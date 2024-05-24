<script lang="ts">
import {defineComponent} from 'vue'
// import {TextComponent, render, RenderNode, fromFormattedString, flat} from "@xmcl/text-component";

export default defineComponent({
    name: "ServerListItem",
    props: ['server'],
    setup() {
        function formatMinecraftText(text) {
            const colorMapping = {
                '0': 'black', '1': 'darkblue', '2': 'darkgreen', '3': 'darkaqua',
                '4': 'darkred', '5': 'darkpurple', '6': 'gold', '7': 'gray',
                '8': 'darkgray', '9': 'blue', 'a': 'green', 'b': 'aqua',
                'c': 'red', 'd': 'lightpurple', 'e': 'yellow', 'f': 'white'
            };

            let htmlText = '';
            let currentColor = 'white'; // Default color

            for (let i = 0; i < text.length; i++) {
                if (text[i] === '§' && i + 1 < text.length) {
                    const code = text[i + 1];
                    if (colorMapping[code]) {
                        currentColor = colorMapping[code];
                        i++;
                        continue;
                    } else if (code === 'l') {
                        htmlText += '<b>';
                    } else if (code === 'm') {
                        htmlText += '<strike>';
                    } else if (code === 'o') {
                        htmlText += '<i>';
                    } else if (code === 'r') {
                        htmlText += '</b></strike></i>';
                        currentColor = 'white'; // Reset to default color
                    }
                } else {
                    htmlText += `<span style="color: ${currentColor}">${text[i]}</span>`;
                }
            }

            return htmlText;
        }

        return {
            formatMinecraftText
        }
    }
})
</script>

<template>
    <!-- Card -->
    <a class="group rounded-xl relative bg-gray-800 p-4" href="#">
        <span class="absolute top-0 end-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white">{{ server.players.online }} / {{ server.players.max }}</span>
        <div class="sm:flex">
            <div class="flex-shrink-0 relative rounded-xl">
                <img class="size-[80px] rounded-xl" :src="server.favicon" alt="Image Description">
            </div>
            <div class="grow mt-4 sm:mt-0 sm:ms-6 px-4 sm:px-0">
                <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white" v-html="formatMinecraftText(server.version.name)" />
                <p class="mt-3 text-gray-300" v-html="server.description" />
            </div>
        </div>
    </a>
    <!-- End Card -->
</template>

<style scoped>

</style>
