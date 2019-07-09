var uuid = require( 'uuid' );

export default {

    namespaced : true,
    state : {

        tasks     : JSON.parse( localStorage.getItem( 'tasks' ) ) || [],
        taskModel : {

            id           : null,
            title        : '',
            completed    : false,
            parent       : null,
            isParent     : false,
            isChild      : false,
            subtasks     : [],
            active       : false,
            // created      : new Date().toLocaleString( 'default' ),
            // completed_at :
            // updated      : null
        }
    },
    mutations: {

        addTask( state, task ) {

            task.id = uuid.v4();
            state.tasks.push( task );
            localStorage.setItem( 'tasks', JSON.stringify( state.tasks ) );
        },
        saveTasks( state, tasks = state.tasks ){

            state.tasks = tasks;
            localStorage.setItem( 'tasks', JSON.stringify( state.tasks ) );
        }
    },
    actions: {

        addTask( context, data ){

            if( data.task.title != '' ){

                if( data.parent != null ) {

                    data.task.isChild = true;
                    data.task.parent  = data.parent.id;
                    data.parent.subtasks.push( data.task );
                    context.commit( 'saveTasks' );
                } else context.commit( 'addTask', data.task );
            }
            else console.log( 'invalid task' );
        },
        toggleParent( context, task ){

            task.isParent = !task.isParent;
            task.active   = task.isParent;
            task.subtasks = [];
            context.commit( 'saveTasks' );
        },
        deleteTask( context, { task, index }){

            if( task.isChild ){

                const parent = context.state.tasks.find( t => t.id == task.parent );
                parent.subtasks.splice( index, 1 );
            } else {

                context.state.tasks.splice( index, 1 );
            }
            context.commit( 'saveTasks' );
        },
        updateTasks: context => context.commit( 'saveTasks' )
    },
    getters: {

        tasks     : state => state.tasks,
        taskModel : state => state.taskModel,
        taskStats( state ){

            let completed = 0;
            let total = 0;
            state.tasks.forEach( task => {

                if( task.completed ) completed++;
                if( task.subtasks.length > 0 ) task.subtasks.forEach( sub => { if( sub.completed ) completed++; } );
                total += ( 1 + task.subtasks.length );
            });

            return {

                completed,
                remaining : total - completed,
                total
            }
        }
    }
};