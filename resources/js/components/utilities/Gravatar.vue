<template>

    <v-avatar class="mt-1 mb-1" :size=" size ">

        <img :src=" gravatarURL( user.email ) " alt="avatar">
    </v-avatar>
</template>

<script>

    import interactsWithGravatar from '../mixins/interactsWithGravatar';

    export default {

        mixins: [ interactsWithGravatar ],
        props: {

            user: {

                type     : Object,
                required : true
            },
            size: {

                type    : String,
                default : '100px'
            }
        }
    }
</script>

<style>

</style>
