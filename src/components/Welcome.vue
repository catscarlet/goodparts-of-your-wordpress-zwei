<template>
<div>
    <div v-if="!is_mobile">
        <span>The Good Parts of Your WordPress</span>
        <br>
        <span>← Click the item in the menu ←</span>
    </div>
    <div v-else>
        <span>The Good Parts of Your WordPress</span>
        <br>
        <br>
        <div class="wrapper">
            <span class="slide with-icon">
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
                <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
            </span>
        </div>

        <span class="with-icon">
            <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon> → Slide → <mu-icon value="keyboard_arrow_right" color="#395c7d"></mu-icon>
        </span>

        <span class="with-icon"> Or touch the <mu-icon value="menu" color="#395c7d"></mu-icon> on the top left</span>
    </div>

</div>
</template>

<script>
import {
    isMobile
} from '../common/';

export default {
    props: [
    ],
    data() {
        return {
            is_mobile: null,
        };
    },
    methods: {
    },
    beforeMount() {
        this.is_mobile = isMobile();
    },
    mounted() {
        this.handleResize = () => {
            this.is_mobile = isMobile();
        };
        window.addEventListener('resize', this.handleResize);
    },
    watch: {
    },
};
</script>

<style>
.wrapper {
    font-size: 24px;
    margin: 0 auto;
    text-align: center;
    width: 168px;
    max-width: 80vw;
    max-height: 36px;
    overflow: hidden;
    /*border: 1px solid black;*/
    white-space: nowrap;
}

.slide {
    display: flex;
    justify-content: center;
    left: -12px;
    position: relative;
    animation: slide 0.75s linear;
    animation-delay: 0.25s;
    animation-iteration-count: infinite;
}

@keyframes slide {
    0% {
        left: -12px;
    }

    100% {
        left: 12px;
    }
}

.with-icon {
    display: flex;
    justify-content: center;
}
</style>
