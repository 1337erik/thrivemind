<template>

    <v-list-tile>

        <v-list-tile-action>

            <v-checkbox v-model=" task.completed " @change=" updateTasks "></v-checkbox>
        </v-list-tile-action>

        <v-list-tile-content>

            <v-text-field
                ref="title"
                v-if=" editing "
                label="Task Title"
                v-model=" task.title "
                @keyup.enter=" update "
                style="width:100%"
            ></v-text-field>
            <v-list-tile-title v-else @click=" startEditing() " class="secondary--text" :class=" task.completed ? 'text--lighten-3' : '' ">{{ task.title }}</v-list-tile-title>
            <!-- <v-list-tile-sub-title>{{ timestamp }}</v-list-tile-sub-title> -->
        </v-list-tile-content>

        <v-list-tile-action>

            <v-layout row align-center>


                <v-scroll-x-transition group mode="out-in">

                    <v-btn flat icon
                        v-if=" task.completed "
                        color="success"
                        key="1"
                        class="mx-1">

                        <v-icon>
                            check
                        </v-icon>
                    </v-btn>

                    <v-btn flat icon @click=" startEditing() " color="primary" class="mx-1" v-if=" !task.completed " key="2">

                        <v-icon>edit</v-icon>
                    </v-btn>

                    <v-btn flat icon @click=" toggleParent( task ) " color="secondary" class="mx-1" v-if=" !task.completed && !task.isChild " key="3">

                        <v-icon>list</v-icon>
                    </v-btn>
                </v-scroll-x-transition>

                <!-- <v-scroll-x-transition>

                    <v-tooltip top v-if=" !task.completed ">

                        <span>Edit Task</span>
                        <template v-slot:activator="{ on }">

                            <v-btn flat icon @click=" startEditing() " color="primary" class="mx-1" v-on=" on ">

                                <v-icon>edit</v-icon>
                            </v-btn>
                        </template>
                    </v-tooltip>
                </v-scroll-x-transition>

                <v-scroll-x-transition>

                    <v-tooltip top v-if=" !task.completed && !task.isChild ">

                        <span>Add Subtasks</span>
                        <template v-slot:activator="{ on }">

                            <v-btn flat icon @click=" toggleParent( task ) " color="secondary" class="mx-1" v-on=" on ">

                                <v-icon>list</v-icon>
                            </v-btn>
                        </template>
                    </v-tooltip>
                </v-scroll-x-transition> -->

                <v-tooltip top>

                    <span>Delete</span>
                    <template v-slot:activator="{ on }">

                        <v-btn flat icon @click=" deleteTask( { task, index } ) " color="error" class="mx-1" v-on=" on ">

                            <v-icon>delete</v-icon>
                        </v-btn>
                    </template>
                </v-tooltip>
            </v-layout>
        </v-list-tile-action>
    </v-list-tile>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {

        data(){

            return {

                editing : false
            }
        },
        props: {

            task  : Object,
            index : Number
        },
        methods: {

            ...mapActions({

                toggleParent : 'todo/toggleParent',
                updateTasks  : 'todo/updateTasks',
                deleteTask   : 'todo/deleteTask'
            }),
            update(){

                this.editing = !this.editing;
                this.updateTasks();
            },
            startEditing(){

                this.editing = !this.editing;
                if( this.editing ) this.$nextTick( () => { this.$refs.title.focus(); });
            }
        },
        computed: {

            ...mapGetters({


            }),
            timestamp(){

                if( this.task.completed ) return this.task.created;
                else return this.task.completed_at;
            }
        }
    }
</script>

<style>

</style>
