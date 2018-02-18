<template>
    <aside id="sidebar" class="column is-2">
        <div class="title is-5">Side info</div>
        <p class="is-4">
            <div>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla, at ipsa quidem sint minima laudantium reprehenderit repudiandae voluptas voluptate facilis quas! Consequatur unde natus sint pariatur explicabo quam doloribus quae.</div>
        </p>
        <hr>
        <label class="checkbox">
        <input type="checkbox" :checked="settings.debug" @click="debugToggle">
          Debug Mode
        </label>
    </aside>
</template>
<script>
    export default {
        props:['settings'],
        methods: {
            debugToggle: function(){
                this.$emit('debugToggle');
            }
        }
    }
</script>