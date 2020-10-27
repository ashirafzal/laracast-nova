<template>
    <card class="flex flex-col items-center justify-center">
        <digital-clock blink="card.blink" :displaySeconds="card.displaySeconds"/>
    </card>
</template>

<script>

import DigitalClock from 'vue-digital-clock'

export default {
    props: ['card'],

    components: {
        DigitalClock,
    },

    mounted() {
        //
    },
}
</script>