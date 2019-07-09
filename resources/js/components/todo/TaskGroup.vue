<template>

    <v-list-group
        v-model=" task.active "
        :prepend-icon=" task.active ? 'keyboard_arrow_down' : 'keyboard_arrow_up' "
        :append-icon=" '' "
        class="">

        <template v-slot:activator>

            <v-list-tile>

                <v-list-tile-content>

                    <v-list-tile-title class="secondary--text" :class=" subtasksCompleted ? 'text--lighten-3' : '' ">{{ task.title }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>

                    <v-layout row>

                        <v-tooltip top>

                            <span>Remove Subtasks</span>
                            <template v-slot:activator="{ on }">

                                <v-btn flat icon @click=" toggleParent( task ) " class="mx-1" color="secondary" v-on=" on ">

                                    <v-icon>list</v-icon>
                                </v-btn>
                            </template>
                        </v-tooltip>

                        <v-tooltip top>

                            <span>Delete Entire Group</span>
                            <template v-slot:activator="{ on }">

                                <v-btn flat icon @click=" deleteTask( { task, index } ) " class="mx-1" color="error" v-on=" on ">

                                    <v-icon>delete</v-icon>
                                </v-btn>
                            </template>
                        </v-tooltip>
                    </v-layout>
                </v-list-tile-action>
            </v-list-tile>
        </template>

        <task
            v-for=" ( subtask, j ) in task.subtasks "
            :key=" j "
            :task=" subtask "
            :index=" j "
            class="pl-5"
        ></task>

        <v-list-tile class="pl-5">

            <v-layout row>

                <v-flex grow>

                    <v-text-field
                        label="Add Sub Task"
                        v-model=" newTask.title "
                        class="pr-4"
                        @keyup.enter=" addTask( task ) "
                    ></v-text-field>
                </v-flex>
                <v-flex shrink>

                    <v-list-tile-action>

                        <v-btn color="primary" @click=" addTask " class="px-2">

                            <v-icon dark left>save</v-icon>
                            Add Task
                        </v-btn>
                    </v-list-tile-action>
                </v-flex>
            </v-layout>
        </v-list-tile>

    </v-list-group>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {

        props: {

            task  : Object,
            index : Number
        },
        data(){

            return {

                newTask : {}
            }
        },
        methods: {

            ...mapActions({

                toggleParent : 'todo/toggleParent',
                deleteTask   : 'todo/deleteTask'
            }),
            addTask(){

                const data = {

                    task   : this.newTask,
                    parent : this.task
                };

                this.$store.dispatch( 'todo/addTask', data );
                this.newTask = _.cloneDeep( this.taskModel );
            }
        },
        computed: {

            ...mapGetters({

                taskModel : 'todo/taskModel'
            }),
            subtasksCompleted(){

                return this.task.subtasks.filter( task => !task.completed ).length == 0;
            },
        },
        mounted(){

            this.newTask = _.cloneDeep( this.taskModel );
        }
    }
</script>

<style>

</style>
