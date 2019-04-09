<template>
<div id="app">
    <Blog />
</div>
</template>

<script>
import Blog from './components/Blog.vue';

export default {
    name: 'app',
    components: {
        Blog,
    },
};
</script>

<style>
body {
    background-color: #bcccc9;
}
</style>
