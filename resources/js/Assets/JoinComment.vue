<script setup>
import BigComment from './BigComment.vue';
import SmallComment from './SmallComment.vue';

const props = defineProps({
    sunlight:Number,
    watering:Number
});

const commentSun = () => {
    switch (props.sunlight) {
        case 0:
            return "Satan's Armpit";
        case 1:
            return "Mordor";
        case 2:
            return "Winduh Sill";
        case 3:
            return "In the Shade...";
        case 4:
            return "Baskin'";
        case 5:
            return "Tan it up";
        default:
            return "";
    }
};

const commentWater = () =>{
    switch(props.watering){
        case 0:
            return "Dry as a Dessert";
        case 1:
            return "Drop it";
        case 2:
            return "DrizzleMaNizzle";
        case 3:
            return "Let it Rain";
        case 4:
            return "Showers";
        case 5:
            return "Heart will go on";
        default:
            return "";
    }
};


const commentS = commentSun();

const commentW = commentWater();


</script>


<template>
    <div class="flex flex-col justify-center items-center">

        <BigComment :commentS="commentS" :commentW="commentW"/>
        

    <SmallComment/>
    
</div>
</template>