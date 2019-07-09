<template>

    <div class="time-wrap">

        <div class="action-bar-wrapper">

            <button type="button" @click=" clockIsRunning ? stopCounting() : startCounting() ">{{ clockIsRunning ? 'Stop' : 'Start' }}</button>
            <button type="button" @click=" clockIsRunning ? timestamp() : resetCounter() ">{{ clockIsRunning ? 'Timestamp' : 'Reset' }}</button>
        </div>

        <canvas id="canvas" width="350" height="350"></canvas>

        <div class="timestamp-column">

            <div class="timestamp-entry" v-for=" ( timestamp, index ) in timestamps " :key=" index ">

                <p>{{ ( timestamps.length - index ).toLocaleString( 'en-US', { minimumIntegerDigits: 2, useGrouping: false } ) }}</p>
                <p>{{ formatTime( timestamp.time ) }}</p>
                <p>{{ formatTime( timestamp.time - ( index == timestamps.length - 1 ? 0 : timestamps[ index + 1 ].time ) ) }} </p>
            </div>
        </div>

        <!-- <div class="meta-data-wrapper">

            <div class="interval-column">

                <div :class=" 'interval-wrap' + ( currentInterval == index ? ' active-interval' : '' ) " v-for=" ( interval, index ) in rawIntervals " :key=" index ">

                    <div>

                        <p class="interval-name">{{ interval.name }}</p>
                        <p class="interval-time">{{ interval.time / 1000 }}</p>
                    </div>
                </div>
                <div class="interval-wrap">

                    <div class="input-wrap">

                        <input placeholder="name" type="text" v-model=" newInterval.name " />
                        <input placeholder="seconds" type="text" v-model=" newInterval.time " />
                    </div>
                    <button class="" type="button" @click=" addInterval() ">Add</button>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>

    export default {

        data: () => ({

            direction         : 1, // 1 || -1
            clockIsRunning    : false,
            previouslyElapsed : 0, // holds the amount of time recorded and saved, so far
            clockCycleStart   : 0, // holds the time that the timer starts
            elapsedNow        : 0, // holds the current time elapsed during this cycle
            milestone         : 0, // holds a 'time limit' for a timer or stopwatch
            elapsedTotal      : 0, // the current time elapsed, including previous clock cycles and current clock cycle
            rawIntervals      : [], // will hold any time intervals the user desires to track
            newInterval       : {

                name: '',
                time: ''
            },
            timestamps        : [], // will hold any timestamps or 'laps' that the user tracks
            animationId       : null, // holds the ID for stopping the animation cycle
        }),
        methods: {

            addInterval(){

                if( ![ null, '' ].includes( this.newInterval.name.trim() ) && !isNaN( this.newInterval.time ) && this.newInterval.time > 0 ){

                    this.newInterval.time = parseInt( this.newInterval.time ) * 1000;
                    this.rawIntervals.push( { ...this.newInterval } );
                    this.newInterval.name = '';
                    this.newInterval.time = '';
                } else {

                    console.log( 'incorrect' );
                }
            },
            toggleDirection(){ this.direction *= -1; },
            stopCounting(){
                this.clockIsRunning = false;

                console.log( 'cancelling.. ' );
                this.previouslyElapsed = this.elapsedTotal;
                cancelAnimationFrame( this.animationId );
                this.animationId = null;
            },
            startCounting(){
                this.clockIsRunning = true;

                console.log( 'starting..' );
                this.clockCycleStart = new Date().getTime();
                this.animationId = requestAnimationFrame( this.runClock );
            },
            timestamp(){

                this.timestamps.unshift({

                    time: this.elapsedTotal
                });
            },
            resetCounter(){

                this.previouslyElapsed = 0;
                this.timestamps        = [];
                this.elapsedTotal      = 0;
                this.renderTime();
            },
            runClock( count ){

                this.elapsedNow   = new Date().getTime() - this.clockCycleStart;
                this.elapsedTotal = this.previouslyElapsed + this.elapsedNow;
                this.renderTime();

                // console.log( 'elapsed Total: ', this.elapsedTotal );
                this.animationId = requestAnimationFrame( this.runClock );
            },
            degToRad( degree ){

                let factor = Math.PI / 180;
                return degree * factor;
            },
            renderTime(){
                // the main function to print the time to the canvas

                let canvas = document.getElementById( 'canvas' );
                let ctx    = canvas.getContext( '2d' );

                // let now   = new Date();
                // let today = now.toDateString();
                // let time  = now.toLocaleTimeString().substr( 0, 8 );
                // let hrs   = now.getHours();
                // let min   = now.getMinutes();
                // let sec   = now.getSeconds();
                // let mil   = now.getMilliseconds();

                // let smoothsec = sec + ( mil / 1000 );
                let smoothsec = this.timeElapsed.s + ( this.timeElapsed.ms / 1000 );
                let smoothmin = this.timeElapsed.m + ( this.timeElapsed.s / 60 );
                
                // ctx.createRadialGradient()
                let gradient = ctx.createRadialGradient( 175, 175, 5, 250, 250, 200 );
                // gradient.addColorStop( 0, '#03303a' );
                gradient.addColorStop( 1, '#fafafa' );
                ctx.fillStyle = gradient;
                ctx.clearRect( 0, 0, 350, 350 );
                ctx.fillRect( 0, 0, 350, 350 );

                // // Hours
                // ctx.beginPath();
                // ctx.arc( 250, 250, 200, this.degToRad( 270 ), this.degToRad( ( hrs * 30 ) - 90 ) );
                // ctx.stroke();

                if( this.timeElapsed.ms != 0 && ( this.timeElapsed.m + 1 ) % 2 ){
                    // on every even minute

                    ctx.strokeStyle = '#000000';
                    ctx.lineWidth   = 17;
                    ctx.shadowBlur  = 15;
                    ctx.shadowColor = '#00ffff';

                    // Minutes
                    ctx.beginPath();
                    ctx.arc( 180, 180, 140, this.degToRad( 270 ), this.degToRad( -90 ) );
                    ctx.stroke();

                    ctx.strokeStyle = '#00ffff';
                    ctx.lineWidth   = 17;
                    ctx.shadowBlur  = 15;
                    ctx.shadowColor = '#00ffff';

                    // Seconds
                    ctx.beginPath();
                    ctx.arc( 180, 180, 140, this.degToRad( 270 ), this.degToRad( ( smoothsec * 6 ) - 90 ) );
                    ctx.stroke();
                } else {
                    // on every odd minute

                    ctx.strokeStyle = '#00ffff';
                    ctx.lineWidth   = 17;
                    ctx.shadowBlur  = 15;
                    ctx.shadowColor = '#00ffff';

                    // Minutes
                    ctx.beginPath();
                    ctx.arc( 180, 180, 140, this.degToRad( 270 ), this.degToRad( -90 ) );
                    ctx.stroke();

                    ctx.strokeStyle = '#000000';
                    ctx.lineWidth   = 17;
                    ctx.shadowBlur  = 15;
                    ctx.shadowColor = '#00ffff';

                    // Seconds
                    ctx.beginPath();
                    ctx.arc( 180, 180, 140, this.degToRad( 270 ), this.degToRad( ( smoothsec * 6 ) - 90 ) );
                    ctx.stroke();
                }

                // Minutes ( old reference )
                // ctx.beginPath();
                // ctx.arc( 250, 250, 170, this.degToRad( 270 ), this.degToRad( ( smoothmin * 6 ) - 90 ) );
                // ctx.stroke();

                // // Date
                // ctx.font = "25px Helvetica";
                // ctx.fillStyle = 'rgba( 00, 255, 255, 1 )';
                // ctx.fillText( today, 175, 250 );

                // Center Time Tracker
                ctx.font = "24px Helvetica Bold";
                ctx.fillStyle = 'rgba( 00, 00, 255, 1 )';
                // ctx.fillText( time + " : " + mil, 175, 280 );
                ctx.fillText( this.formatTime( this.elapsedTotal ), 155, 150 );
                if( this.timestamps.length > 0 ) {

                    ctx.font = "16px Helvetica Bold";
                    ctx.fillStyle = 'rgba( 00, 00, 225, 1 )';
                    ctx.fillText( this.formatTime( this.elapsedTotal - this.timestamps[ 0 ].time ), 165, 175 );
                }
            },
            formatTime( time ){

                let ms = Math.floor( time % 1000 );
                let s = Math.floor( ( time / 1000 ) ) % 60;
                let m = Math.floor( ( time / 60000 ) ) % 60;
                return m + ':' + s + ':' + ms;
            }
        },
        computed: {

            timeElapsed(){
                // might not need this... abstracted into the formateTime() function
                // to use elsewhere..

                let ms = Math.floor( this.elapsedTotal % 1000 );
                let s = Math.floor( ( this.elapsedTotal / 1000 ) ) % 60;
                let m = Math.floor( ( this.elapsedTotal / 60000 ) ) % 60;
                return {

                    ms,
                    s,
                    m
                }
            },
            timeRemaining(){

                return 'lmao okay';
            },
            totalIntervalSum(){

                return this.rawIntervals.reduce( ( total, interval ) => total + interval.time, 0 )
            },
            refinedIntervals(){

                for( var i = 0; i < this.rawIntervals.length; i++ ){

                    let sumThusFar = this.rawIntervals[ 0 ].time;
                    for( var j = 1; j <= i; j++ ){

                        sumThusFar += this.rawIntervals[ j ].time;
                    }
                    this.rawIntervals[ i ].sumThusFar = sumThusFar;
                }
                return this.rawIntervals;
            },
            currentInterval(){

                for( var i = 0; i < this.refinedIntervals.length; i++ ){

                    if( ( this.elapsedTotal % this.totalIntervalSum ) < this.refinedIntervals[ i ].sumThusFar ) return i;
                }
            }
        },
        mounted(){

            this.renderTime();
        }
    }
</script>

<style scoped>

    /* the main container element */
    .time-wrap {

        display: flex;
        flex-direction: column;

        height: 100%;
        padding-top: 55px;
        text-align: center;
        font-size: 35px;
        width: 100%;
        max-width: 350px;
        margin: auto;
    }

    /* action bar, for the start/stop buttons */
    .action-bar-wrapper {

        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 250px;
        margin: 45px auto 0px;
    }
    .action-bar-wrapper > button {

        font-size: 16px;
        flex: 1;
    }
    .action-bar-wrapper > button:focus {

        outline: none;
    }
    .action-bar-wrapper > button:first-child {

        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }
    .action-bar-wrapper > button:last-child {

        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    /* styles for the time stamp columns */
    .timestamp-column {

        flex: 1;
        flex-direction: column;
        margin: 15px 0px;
        max-height: 350px;
        overflow-y: scroll;
    }

    .timestamp-entry {

        display: flex;
        justify-content: space-between;
        font-size: 16px;
        margin: 5px;
    }

    .timestamp-entry > p {

        font-size: 16px;
        margin: 0;
        color: #0000ff;
    }

    .timestamp-entry > p:nth-child( 2 ) {

        font-size: 24px;
        color: #0000ff;
    }




    .meta-data-wrapper {

        background-color: white;
        padding: 25px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0px 2px 5px #ccc;
    }

    .interval-column {

        flex: 1;
        flex-direction: column;
    }

    .interval-wrap {

        display: flex;
        flex-direction: column;
    }

    .active-interval {

        border: 1px solid blue;
    }

    .interval-name,
    .interval-time,
    .input-wrap > input {

        margin: 0;
        display: inline-block;
        width: 50%;
    }
</style>
