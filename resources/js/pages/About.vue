<template>
    <div>
        <h1>About us</h1>

    </div>
</template>

<script>
export default {
    name: "About"
}
</script>

<style scoped>
.myFade-enter-active{
    transition: all .5s ease;
}
.myFade-leave-active{
    transition: all .1ms ease;
}


.myFade-enter /* .myFade-leave-active below version 2.1.8 */
{
    transform: translateX(40px);
    opacity: 0;
}
.myFade-leave-to{
    transform: translateY(40px);
    opacity: 0;
}
</style>
