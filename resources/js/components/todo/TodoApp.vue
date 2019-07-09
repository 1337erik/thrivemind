<template>

    <v-card>

        <v-layout pa-3 align-center>

            <strong class="mx-3 info--text text--darken-3">

                Remaining: {{ taskStats.remaining }}
            </strong>

            <v-divider vertical></v-divider>

            <strong class="mx-3 info--text text--darken-3">

                Completed: {{ taskStats.completed }}
            </strong>

            <v-spacer></v-spacer>

            <v-progress-circular
                :value=" taskStats.completed / taskStats.total * 100 "
                class="mr-2">
            </v-progress-circular>
        </v-layout>

        <v-divider></v-divider>

        <v-list two-line>

            <!-- if subtasks, display as a group with dropdown. Each subtask is the same as a regular task -->

            <template v-for=" ( task, i ) in tasks ">

                <task-group :task=" task " :index=" i " :key=" i " v-if=" task.isParent "></task-group>
                <task :task=" task " :index=" i " :key=" i " v-else></task>
            </template>

            <v-divider></v-divider>

            <v-list-tile>

                <v-layout row>

                    <v-flex grow>

                        <v-text-field
                            label="Add New Task"
                            v-model=" newTask.title "
                            ref="email"
                            class="pr-4"
                            @keyup.enter=" addTask "
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
        </v-list>
    </v-card>
</template>

<script>

    import { mapGetters } from 'vuex';
    import _ from 'lodash';

    export default {

        data: () => ({

            newTask : {}
        }),
        methods: {

            addTask(){

                const data = {

                    task   : this.newTask,
                    parent : null
                };

                this.$store.dispatch( 'todo/addTask', data );
                this.newTask = _.cloneDeep( this.taskModel );
            }
        },
        computed: {

            ...mapGetters({

                tasks     : 'todo/tasks',
                taskModel : 'todo/taskModel',
                taskStats : 'todo/taskStats'
            })
        },
        mounted(){

            this.newTask = _.cloneDeep( this.taskModel );
        }
    }
</script>

<style>

</style>