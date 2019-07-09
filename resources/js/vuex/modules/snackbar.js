
export default {

    namespaced : true,
    state: {

        show: false,
        color: 'error',
        text: 'an error occured',
        subText: '',
        timeout: 6000
    },
    mutations: {

        set_snackbar_show( state, show ){

            state.show = show;
        },
        set_snackbar_color( state, color ){

            state.color = color;
        },
        set_snackbar_text( state, text ){

            state.text = text;
        },
        set_snackbar_subtext( state, subText ){

            state.subText = subText;
        },
        set_snackbar_timeout( state, timeout ){

            state.timeout = timeout;
        }
    },
    getters: {

        snackbarShow    : state => state.show,
        snackbarColor   : state => state.color,
        snackbarText    : state => state.text,
        snackbarSubtext : state => state.subText,
        snackbarTimeout : state => state.timeout,
    }
}