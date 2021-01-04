<template>
    <div>
        <Loader v-if="loading"></Loader>
        <div v-else>
            <div class="row">
                <div class="d-flex justify-content-between">
                    <h3 class="">Todo List</h3>
                    <transition name="bounce">
                        <div v-if="message" class="myBadge badge" :class="badgeType">
                            <h5>{{ message }}</h5>
                        </div>
                    </transition>

                </div>
                <div class="col-md-8 col-sm-12 offset-md-2 mt-5">
                    <!--            <form>-->
                    <div class="input-group mb-3">
                        <input type="text" name="task" v-on:keyup.enter="addTask()" class="form-control" v-model="task"
                               placeholder="Task">
                        <button class="btn btn-outline-secondary" v-on:click="addTask()" type="button">ADD</button>
                    </div>
                    <!--            </form>-->
                    <div class="card mt-3">
                        <div class="card-header">
                            Task List
                        </div>
                        <transition-group name="fade">

                            <ul class="list-group list-group-flush" v-for="(item,index) in taskList" :key="item.id">
                                <li @click="taskComplete(item.id,index)"
                                    class="list-group-item listItem d-flex justify-content-between border-bottom">
                            <span
                                :style="[item.status==1?{'text-decoration':'line-through'}:{'text-decoration':'none'}]">
                                {{ item.task }}
                            </span>
                                    <button @click="deleteTask(item.id,index)" class="btn btn-danger btn-sm">Delete
                                    </button>
                                </li>
                            </ul>

                        </transition-group>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Loader from "../components/loader"

export default {
    name: "TodoList",
    components: {
        Loader,
    },
    data() {
        return {
            task: '',
            taskList: [],
            message: '',
            badgeType: '',
            loading: false,
        }
    },
    mounted() {
        this.LoadTodoList();
    },
    methods: {
        LoadTodoList() {
            // this.loading = true;
            axios.get('/api/todoList/list')
                .then((response) => {
                    this.taskList = response.data;
                    // this.loading = false;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        alert(msg, badgeType) {
            this.message = msg;
            this.badgeType = 'bg-' + badgeType;
            setTimeout(() => {
                this.message = '';
                this.badgeType = '';
            }, 3000);
        },

        addTask() {
            let input = {};
            input['task'] = this.task;
            axios.post('/api/todoList/add', input)
                .then((response) => {
                    this.task = '';
                    this.LoadTodoList();
                    this.alert(response.data, 'success')
                    console.log(response);
                })
                .catch(function (err) {
                    console.log(err);
                })
        },

        deleteTask(id, index) {
            axios.delete('/api/todoList/delete/' + id)
                .then((response) => {
                    this.taskList.splice(index, 1);
                    this.alert(response.data, 'danger')                //alert
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        taskComplete($id, index) {
            let data = {};
            data['id'] = $id;
            axios.post('/api/todoList/taskComplete', data)
                .then((response) => {
                    this.LoadTodoList();
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }

}
</script>

<style scoped>
.listItem:hover {
    background-color: rgba(0, 0, 0, 0.05);
    cursor: pointer;
}

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

.bounce-enter-active {
    animation: bounce-in .5s;
}

.bounce-leave-active {
    animation: bounce-in .5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.12);
    }
    100% {
        transform: scale(1);
    }
}


.fade-enter-active, .fade-leave-active {
    transition: all .5s ease;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
    transform: translateX(40px);
    opacity: 0;
}


.myBadge {
    position: fixed;
    right: 8vw;
    top: 8vh;
}
</style>
