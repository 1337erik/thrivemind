<template>

    <v-layout wrap>

        <v-flex xs12>

            <v-card min-height="500">

                <v-toolbar class="primary white--text">

                    <v-toolbar-title>Task Calendar View</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn flat icon class="white--text" @click=" openCreateForm() ">

                        <v-icon>add_circle</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-calendar
                    ref="calendar"
                    v-model=" start "
                    :type=" type "
                    :end=" end "
                    color="primary"
                    style="min-height:550px"
                >

                    <template v-slot:day="{ date }">

                        <template v-for=" event in events[ date ]">

                            <v-menu
                                :key=" event.title "
                                v-model=" event.open "
                                full-width
                                offset-x>

                                <template v-slot:activator="{ on }">

                                    <div
                                        v-if=" !event.time "
                                        v-ripple
                                        class="my-event"
                                        v-on=" on "
                                        v-html=" event.title ">
                                    </div>
                                </template>
                                <v-card
                                    color="grey lighten-4"
                                    min-width="350px"
                                    flat>

                                    <v-toolbar class="primary white--text">

                                        <v-btn icon class="white--text" @click=" openEditForm( event ) ">

                                            <v-icon>edit</v-icon>
                                        </v-btn>
                                        <v-toolbar-title v-html=" event.title "></v-toolbar-title>
                                    </v-toolbar>
                                    <v-card-title primary-title>

                                        <span v-html=" event.description "></span>
                                    </v-card-title>
                                    <v-card-actions>

                                        <v-btn flat class="primary white--text" @click=" openEditForm( event ) ">Edit</v-btn>
                                        <v-btn flat class="error white--text" @click=" deleteTask( event ) ">Delete</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-menu>
                        </template>
                    </template>
                </v-calendar>
            </v-card>
        </v-flex>

        <v-flex xs12>

            <activity-log></activity-log>
        </v-flex>

        <v-dialog v-model=" modalOpen " persistent max-width="1000px">

            <v-card>

                <v-card-title class="headline">Hello I am Modal</v-card-title>

                <v-card-text>

                    <v-container grid-list-md>

                        <v-form ref="createTaskForm" v-model=" taskValid ">

                            <v-layout wrap>

                                <v-flex xs12 sm4>

                                    <v-text-field
                                        name="title"
                                        label="Task Title"
                                        v-model=" newTask.title "
                                        :rules=" titleRules "
                                        :error=" errors[ 'title' ] "
                                        :error-messages=" errors[ 'title' ]"
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm4>

                                    <v-text-field
                                        name="description"
                                        label="Task Description"
                                        v-model=" newTask.description "
                                        :rules=" descriptionRules "
                                        :error=" errors[ 'description' ] "
                                        :error-messages=" errors[ 'description' ]"
                                        required
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm4>

                                    <v-text-field
                                        name="notes"
                                        label="Task Notes"
                                        v-model=" newTask.notes "
                                        :rules=" notesRules "
                                        :error=" errors[ 'notes' ] "
                                        :error-messages=" errors[ 'notes' ]"
                                        required
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout wrap>

                                <v-flex xs12 sm6>

                                    <v-date-picker v-model=" newTask.due_date "></v-date-picker>
                                </v-flex>

                                <v-flex xs12 sm6>

                                    <v-time-picker v-model=" newTask.time " ></v-time-picker>
                                </v-flex>
                            </v-layout>
                        </v-form>
                    </v-container>
                </v-card-text>

                <v-card-actions>

                    <v-spacer></v-spacer>

                    <v-btn color="primary" class="white--text" @click.native=" ( editingTask ? updateTask() : addTask() ) " :loading=" creatingTask ">{{ editingTask ? 'Update Task' : 'Add Task' }}</v-btn>
                    <v-btn @click=" closeModal ">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>

    import moment from 'moment';
    import _ from 'lodash';

    export default {

        data(){

            return {

                type    : 'month',
                start   : '2019-07-01',
                end     : '2019-07-30',


                taskModel : {

                    title       : '',
                    description : '',
                    notes       : '',
                    due_date    : ''
                },
                tasks   : [],
                newTask : {},


                errors     : [],
                titleRules : [

                    ( v ) => !!v || 'Title is required'
                ],
                descriptionRules : [

                    ( v ) => !!v || 'Description is required'
                ],
                notesRules : [

                    ( v ) => !!v || 'Notes are required'
                ],


                modalOpen    : false,
                creatingTask : false,
                editingTask  : false,
                taskValid    : false
            }
        },
        methods: {

            addTask(){

                if ( this.$refs.createTaskForm.validate() ) {

                    // console.log( 'new task: ', this.newTask );
                    this.creatingTask = true;
                    axios.post( '/api/v1/tasks', this.newTask )
                    .then( res => {

                        console.log( 'response creating task: ', res );
                        this.tasks.push( res.data );
                        this.newTask   = _.cloneDeep( this.taskModel );
                        this.modalOpen = false;
                    })
                    .catch( err => {

                        console.log( 'error creating task! ', err );
                    })
                    .then( () => this.creatingTask = false );
                } else console.log( 'sorry, invalid entry' );
            },
            updateTask(){

                if ( this.$refs.createTaskForm.validate() ) {

                    console.log( 'new task: ', this.newTask );
                    this.creatingTask = true;
                    axios.patch( '/api/v1/tasks/' + this.newTask.id, this.newTask )
                    .then( res => {

                        console.log( 'response updating task: ', res );
                        this.newTask   = _.cloneDeep( this.taskModel );
                        this.modalOpen = false;
                    })
                    .catch( err => {

                        console.log( 'error creating task! ', err );
                    })
                    .then( () => this.creatingTask = false );
                } else console.log( 'sorry, invalid entry' );
            },
            deleteTask( event ){

                axios.delete( '/api/v1/tasks/' + event.id )
                .then( res => {

                    console.log( res );
                    this.tasks.forEach( ( task, index ) => {

                        if( task.id == event.id ) this.tasks.splice( index, 1 );
                    });
                })
                .catch( err => console.log( err ) );
            },


            openCreateForm(){

                this.$refs.createTaskForm.reset();
                this.modalOpen   = true;
                this.editingTask = false;
                this.newTask     = _.cloneDeep( this.taskModel );
            },
            openEditForm( task ){

                console.log( task );
                this.$refs.createTaskForm.reset();
                this.modalOpen   = true;
                this.editingTask = true;
                this.newTask     = task;
            },


            closeModal(){

                this.modalOpen   = false;
                this.editingTask = false;
                this.newTask     = _.cloneDeep( this.taskModel );
            }
        },
        computed: {

            events(){

                const events = {};
                this.tasks.forEach( t => ( events[ moment( t.due_date ).format( 'YYYY-MM-DD' ) ] = events[ t.due_date ] || [] ).push( t ) );
                return events;
            }
        },
        mounted(){

            this.newTask = _.cloneDeep( this.taskModel );

            axios.get( '/api/v1/tasks' )
            .then( res => {

                // console.log( 'response: ', res );
                this.tasks = res.data;
            })
            .catch( err => {

                console.log( 'error loading tasks!', err );
            })
        }
    }
</script>

<style scoped>

    .my-event {

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border-radius: 2px;
        background-color: #1867c0;
        color: #ffffff;
        border: 1px solid #1867c0;
        width: 100%;
        font-size: 12px;
        padding: 3px;
        cursor: pointer;
        margin-bottom: 1px;
    }
</style>
