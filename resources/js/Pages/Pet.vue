<template>
    <Header />
    <div class="imageBlock">
        <div
            class="imageBlock_pet"
            id="fox"
            :class="'wait'"
        ></div>
    </div>
</template>

<style lang="scss">
    .imageBlock {

        .imageBlock_pet#fox {
            background-image: url("../../../public/assets/pets/Fox.png");
            width: 90%;
            background-size: 1700px;
            image-rendering: pixelated;
            height: 90px;
            position: absolute;
            animation: fox-wait .5s steps(5, end) infinite;

            &.wait {
                @keyframes fox-wait {
                    from { background-position: -7px -45px; }
                    to { background-position: -614px -45px; }
                }
            }
        }
    }
</style>


<script setup>
import Header from "../Components/Header.vue";
const props = defineProps(['data'])
</script>
