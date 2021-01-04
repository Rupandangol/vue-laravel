<template>
    <h1>Contact Us</h1>
</template>

<script>
export default {
    name: "ContactUs"
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
