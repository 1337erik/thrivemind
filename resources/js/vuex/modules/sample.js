
export default {

    namespaced : true,
    state : {

        testing: 1337
    },
    mutations: {

    },
    actions : {

        sampleAction( { state, commit, rootState } ){

            return 5;
        }
    },
    getters : {

        sampleGetter( state, getters, rootState ){

            return 10;
        }
    }
}