<template>

    <v-card>

        <v-toolbar class="primary white--text">

            <v-toolbar-title>Task Activity Log</v-toolbar-title>
        </v-toolbar>
        <v-card-text>

            <v-card v-for=" ( activity, index ) in activity " :key=" index ">

                {{ activity }}
            </v-card>
        </v-card-text>
    </v-card>
</template>

<script>

    export default {

        data(){

            return {

                activity : []
            }
        },
        mounted(){

            console.log( 'LMAO' );
        }
    }
</script>

<style scoped>

</style>
