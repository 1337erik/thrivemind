<template>

    <li :class=" dropdownClasses " @click=" toggleMenu() ">

        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

            <i :class=" 'nc-icon ' + icon "></i>
        </a>
        <ul :class=" menuClasses ">

            <a class="dropdown-item" href="#">Create New Post</a>
            <a class="dropdown-item" href="#">Manage Something</a>
            <a class="dropdown-item" href="#">Do Nothing</a>
            <a class="dropdown-item" href="#">Submit to live</a>
            <li class="divider"></li>
            <a class="dropdown-item" href="#">Another action</a>
        </ul>
    </li>
</template>

<script>

    export default {

        props: [

            'icon',
        ],
        data: () => {

            return {

                isOpen : false
            }
        },
        computed: {

            dropdownClasses(){

                const base = [ 'dropdown', 'nav-item' ];
                base.push( this.isOpen ? 'show' : '' );
                return base.join( ' ' );
            },
            menuClasses(){

                const base = [ 'dropdown-menu' ];
                base.push( this.isOpen ? 'show' : '' );
                return base.join( ' ' );
            }
        },
        methods: {

            toggleMenu(){

                console.log( 'open: ' + this.isOpen );
                this.isOpen = !this.isOpen;
            }
        }
    }
</script>

<style>

</style>
