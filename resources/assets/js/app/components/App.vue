<template>
    <div class="columns">
        <!-- If sidebar is on the left side -->
        <app-sidebar v-if="settings.sidebar=='left'" :settings="settings"></app-sidebar>

        <!-- Content of Page -->
        <app-content  :settings="settings"></app-content>

        <!-- If sidebar is on the right side -->
        <app-sidebar v-if="settings.sidebar=='right'" :settings="settings"></app-sidebar>

    </div>
</template>
<script>
    export default {
        data: function(){
            return {
                settings: {
                    sidebar: 'left'
                }
            }
        }
    }
</script>