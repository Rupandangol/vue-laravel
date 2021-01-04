<template>
    <div>
        <div class="jumbotron">
            <h1 class="display-4">Your Gallery</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda doloremque dolores
                iusto modi voluptatum. Amet, blanditiis eius explicabo iste odit soluta tempora? Enim eos repellendus
                voluptatibus! Eius eligendi, facilis.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
        <div class="card">
            <div class="card-header">Upload File</div>
<!--            <input type="file" name="items" data-max-files="1" required style="margin: 20px" >-->
            <filePond></filePond>
        </div>
    </div>

</template>
<script>
import filePond from "../components/filePond";
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

export default {

}
</script>
<style scoped>
.myFade-enter-active {
    transition: all .5s ease;
}

.myFade-leave-active {
    transition: all .1ms ease;
}

.myFade-enter /* .myFade-leave-active below version 2.1.8 */
{
    transform: translateX(40px);
    opacity: 0;
}

.myFade-leave-to {
    transform: translateY(40px);
    opacity: 0;
}

</style>
