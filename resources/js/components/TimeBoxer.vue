<template>

    <div class="time-wrap">

        <canvas id="canvas" width="500" height="500"></canvas>

        <!-- <div class="direction-wrapper">

            <button type="button" @click=" toggleDirection() ">{{ direction == 1 ? 'Counting Up' : 'Counting Down' }}</button>
        </div>
        <div class="clock-wrapper">

            <div class="inner-clock-wrap">

                <p>{{ timeElapsed + ' / ' + milestone }}</p>
            </div>
            <p>{{ timeRemaining }}</p>
        </div>
        <div class="action-bar-wrapper">

            <button type="button" @click=" clockIsRunning ? stopCounting() : startCounting() ">{{ clockIsRunning ? 'Stop' : 'Start' }}</button>
            <button type="button" @click=" clockIsRunning ? timestamp() : resetCounter() ">{{ clockIsRunning ? 'Timestamp' : 'Reset' }}</button>
        </div>
        <div class="meta-data-wrapper">

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
            <div class="timestamp-column">

                <div v-for=" ( timestamp, index ) in timestamps " :key=" index ">

                    {{ timestamp.time }}
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


            animationFrame : null, // the animation from for the second timer
            ctx            : null // for canvas element
        }),
        methods: {

            addInterval(){

                if( ![ null, '' ].includes( this.newInterval.name.trim() ) && !isNaN( this.newInterval.time ) && this.newInterval.time > 0 ){

                    this.newInterval.time = parseInt( this.newInterval.time ) * 1000;
                    this.rawIntervals.push( { ...this.newInterval } );
                    this.newInterval.name = '';
                    this.newInterval.time = '';
                } else {

                    console.log( 'incorrect shit' );
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

                this.timestamps.push({

                    time: this.elapsedTotal
                });
            },
            resetCounter(){

                this.previouslyElapsed = 0;
                this.timestamps = [];
                this.elapsedTotal = 0;
            },
            runClock( count ){

                this.elapsedNow = new Date().getTime() - this.clockCycleStart;
                this.elapsedTotal = this.previouslyElapsed + this.elapsedNow;
                console.log( 'elapsed Total: ', this.elapsedTotal );
                this.animationId = requestAnimationFrame( this.runClock );
            },
            changeTime( val ){

                this.totalTime += ( val * 60 * 60 );
            },
            degToRad( degree ){

                let factor = Math.PI / 180;
                return degree * factor;
            },
            renderTime(){

                let canvas = document.getElementById( 'canvas' );
                let ctx = canvas.getContext( '2d' );

                ctx.strokeStyle = '#00ffff';
                ctx.lineWidth = 17;
                ctx.shadowBlur= 15;
                ctx.shadowColor = '#00ffff';

                let now = new Date();
                let today = now.toDateString();
                let time = now.toLocaleTimeString();
                let hrs = now.getHours();
                let min = now.getMinutes();
                let sec = now.getSeconds();
                let mil = now.getMilliseconds();

                let smoothsec = sec + ( mil / 1000 );
                let smoothmin = min + ( smoothsec / 60 );

                let gradient = ctx.createRadialGradient( 250, 250, 5, 250, 250, 300 );
                gradient.addColorStop( 0, '#03303a' );
                gradient.addColorStop( 1, 'black' );
                ctx.fillStyle = gradient;
                ctx.clearRect( 0, 0, 500, 500 );
                ctx.fillRect( 0, 0, 500, 500 );

                // Hours
                ctx.beginPath();
                ctx.arc( 250, 250, 200, this.degToRad( 270 ), this.degToRad( ( hrs * 30 ) - 90 ) );
                ctx.stroke();

                // Minutes
                ctx.beginPath();
                ctx.arc( 250, 250, 170, this.degToRad( 270 ), this.degToRad( ( min * 6 ) - 90 ) );
                ctx.stroke();

                // Seconds
                ctx.beginPath();
                ctx.arc( 250, 250, 140, this.degToRad( 270 ), this.degToRad( ( smoothsec * 6 ) - 90 ) );
                ctx.stroke();

                // Date
                ctx.font = "25px Helvetica";
                ctx.fillStyle = 'rgba( 00, 255, 255, 1 )';
                ctx.fillText( today, 175, 250 );

                // Time
                ctx.font = "25px Helvetica Bold";
                ctx.fillStyle = 'rgba( 00, 255, 255, 1 )';
                ctx.fillText( time + ":" + mil, 175, 280 );

            }
        },
        computed: {

            timeElapsed(){

                let ms = Math.floor( this.elapsedTotal % 1000 );
                let s = Math.floor( ( this.elapsedTotal / 1000 ) ) % 60;
                let m = Math.floor( ( this.elapsedTotal / 60000 ) ) % 60;
                return m + ':' + s + ':' + ms;
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

            setInterval( this.renderTime, 40 );
        }
    }
</script>

<style scoped>

    .time-wrap {

        text-align: center;
        font-size: 35px;
    }

    .clock-wrapper {

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .inner-clock-wrap {

        display: flex;
        justify-content: center;
    }

    .action-bar-wrapper {

        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 350px;
        margin: auto;
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

    .timestamp-column {

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
