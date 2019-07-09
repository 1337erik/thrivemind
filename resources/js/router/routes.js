import Main from '../components/pages/Main';

let NotFoundComponent = () => import( '../components/pages/NotFound404' );
let Todo = () => import( '../components/pages/Todo' );
let Timer = () => import( '../components/pages/Timer' );
let Library = () => import( '../components/pages/Library' );
let Fasting = () => import( '../components/pages/IntermittentFasting' );
let Blog = () => import( '../components/pages/Blog' );
let Forum = () => import( '../components/pages/Forum' );
let Coaching = () => import( '../components/pages/Coaching' );
let Subscriptions = () => import( '../components/pages/Subscriptions' );

export default [

    {

        path        : '/dashboard',
        name        : 'Dashboard',
        onNavDrawer : true,
        icon        : 'dashboard',
        component   : Main
    },
    {

        path        : '/library',
        name        : 'The ThriveMind',
        onNavDrawer : true,
        icon        : 'school',
        component   : Library
    },
    {

        path        : '/todo',
        name        : 'Todo App',
        onNavDrawer : true,
        icon        : 'calendar_today',
        component   : Todo
    },
    {

        path        : '/timer',
        name        : 'Timer App',
        onNavDrawer : true,
        icon        : 'av_timer',
        component   : Timer
    },
    {

        path        : '/fastingapp',
        name        : 'Intermittent Fasting App',
        onNavDrawer : true,
        icon        : 'alarm_on',
        component   : Fasting
    },
    {

        path        : '/blog',
        name        : 'Articles',
        onNavDrawer : true,
        icon        : 'book',
        component   : Blog
    },
    {

        path        : '/forum',
        name        : 'Community Forum',
        onNavDrawer : true,
        icon        : 'forum',
        component   : Forum
    },
    {

        path        : '/coaching',
        name        : 'Coaching App',
        onNavDrawer : true,
        icon        : 'accessibility_new',
        component   : Coaching
    },
    {

        path        : '/subscriptions',
        name        : 'Manage Subscription',
        onNavDrawer : true,
        icon        : 'monetization_on',
        component   : Subscriptions
    },
    {

        path        : '*',
        name        : 'not-found',
        onNavDrawer : false,
        component   : NotFoundComponent
    },
]