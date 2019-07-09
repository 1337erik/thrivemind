<template>

    <v-card>

        <v-toolbar class="primary white--text">

            <v-toolbar-title>Task Activity Log</v-toolbar-title>
        </v-toolbar>
        <v-card-text>

            <v-card v-for=" ( activity, index ) in activitylog " :key=" index ">

                <v-list-tile>

                    <v-list-tile-title>{{ 'Task ' + activity.task_id + ' has been ' + activity.description }}</v-list-tile-title>
                </v-list-tile>
            </v-card>
        </v-card-text>
    </v-card>
</template>

<script>

    export default {

        data(){

            return {

                activitylog : []
            }
        },
        mounted(){

            axios.get( '/api/v1/activity' )
            .then( res => {

                // console.log( res );
                this.activitylog = res.data.reverse();
            })
            .catch( err => console.log( err ) );

            window.Echo.channel( 'activity-log' )
            .listen( 'ActivityRecorded', e => {

                this.activitylog.unshift( e.activity );
                console.log( 'new activity has been logged: ', e );
            });
        }
    }
</script>

<style scoped>

</style>
