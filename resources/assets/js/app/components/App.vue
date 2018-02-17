<template>
    <div class="columns">
        <!-- If sidebar is on the left side -->
        <app-sidebar v-if="settings.sidebar_on && settings.sidebar_location=='left'" :settings="settings"></app-sidebar>

        <!-- Content of Page -->
        <app-content  :settings="settings"></app-content>

        <!-- If sidebar is on the right side -->
        <app-sidebar v-if="settings.sidebar_on && settings.sidebar_location=='right'" :settings="settings"></app-sidebar>

    </div>
</template>
<script>
    export default {
        data: function(){
            return {
                settings: {
                    sidebar_on: true,
                    sidebar_location: 'left',
                }
            }
        }
    }
</script>