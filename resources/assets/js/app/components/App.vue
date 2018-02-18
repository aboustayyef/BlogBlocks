<template>
    
    <div class="columns">
        <!-- If sidebar is on the left side -->
        <app-sidebar v-if="settings.sidebar_on && settings.sidebar_location=='left'" 
            v-on:debugToggle="debugToggle"
            :settings="settings">
        </app-sidebar>

        <!-- Content of Page -->
        
        <app-content  :settings="settings" :tag="tag"></app-content>

        <!-- If sidebar is on the right side -->
        <app-sidebar v-if="settings.sidebar_on && settings.sidebar_location=='right'" 
            v-on:debugToggle="debugToggle"
            :settings="settings">
        </app-sidebar>

    </div>

</template>
<script>
    export default {
        props: ['debug','tag'],
        data: function(){
            return {
                settings: {
                    sidebar_on: true,
                    sidebar_location: 'left',
                    debug: eval(this.debug)
                }
            }
        },
        methods: {
            debugToggle: function(){
                var vm = this;
                console.log('changing Debug Status from ' + vm.settings.debug);
                vm.settings.debug = ! vm.settings.debug;
            }
        }
    }
</script>