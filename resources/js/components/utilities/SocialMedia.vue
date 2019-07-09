<template>

    <v-layout flex>

        <v-tooltip :bottom=" tooltip == 'bottom' " :top=" tooltip == 'top' " v-for=" ( icon, i ) in randomIcons " :key=" i ">

            <template v-slot:activator="{ on }">

                <v-btn flat icon :color=" icon.color " v-on=" on " :href=" icon.lynx " target="_blank">

                    <i class="fab" :class=" 'fa-' + icon.icon "></i>
                </v-btn>
            </template>
            <span>{{ icon.tooltip }}</span>
        </v-tooltip>
    </v-layout>
</template>

<script>

    import _ from 'lodash';

    export default {

        props: {

            tooltip : String
        },
        data: () => {

            return {

                icons : [

                    {
                        icon    : 'instagram',
                        tooltip : 'Instagram',
                        color   : 'brown',
                        lynx    : 'https://www.instagram.com/thrivemindsociety/'
                    },
                    {
                        icon    : 'medium',
                        tooltip : 'Medium',
                        color   : 'blue-grey darken-2',
                        lynx    : 'https://medium.com/@erik_develops'
                    },
                    {
                        icon    : 'facebook',
                        tooltip : 'Facebook',
                        color   : 'blue',
                        lynx    : 'https://www.facebook.com/thrivemindsociety-436436193573218/'
                    },
                    {
                        icon    : 'youtube',
                        tooltip : 'Youtube',
                        color   : 'red',
                        lynx    : 'https://www.youtube.com/channel/UC8bxu_Su1Jt6GxT1Roxu1lg'
                    },
                    {
                        icon    : 'pinterest',
                        tooltip : 'Pinterest',
                        color   : 'red',
                        lynx    : 'google.com'
                    }
                ]
            }
        },
        computed: {

            randomIcons(){

                let shuffledArray = _.cloneDeep( this.icons );

                // Fisher-Yates shuffle.. lol
                for ( let i = shuffledArray.length - 1; i > 0; i-- ) {

                    let j = Math.floor( Math.random() * ( i + 1 ) ); // random index from 0 to i
                    [ shuffledArray[ i ], shuffledArray[ j ] ] = [ shuffledArray[ j ], shuffledArray[ i ] ]; // swap elements
                }
                return shuffledArray;
            }
        }
    }
</script>

<style scoped>

    i {

        font-size: 24px;
    }
</style>