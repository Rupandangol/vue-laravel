<template>
    <div>
        <Loader v-if="loading"></Loader>
        <div v-else>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci debitis deserunt dicta est ex facilis,
                hic
                magni molestiae molestias nisi non officia pariatur quos repellendus repudiandae sed soluta vero
                voluptates.</p>

            <div class="d-flex justify-content-between">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                    Add Product
                </button>
                <transition name="fade">
                    <div v-if="message" class="myAlert alert" :class="alertType">{{ message }}</div>
                </transition>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input v-model="productInput.productName" class="form-control" type="text"
                                           name="productName">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" v-model="productInput.category_id" name="category_id">
                                        <option v-for="category in categories" v-bind:value="category.id">
                                            {{ category.category }}
                                        </option>
                                    </select>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" v-on:click="createProduct()" data-dismiss="modal"
                                    class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="">
                        <div class="card-header d-flex justify-content-between myBtn"
                             v-on:click="getCategoryProduct('all')">
                            Category <span v-if="selectedCategory=='all'">>></span>
                        </div>
                        <ul class="list-group list-group-flush" v-for="category in categories">
                            <li v-on:click="getCategoryProduct(category.id)"
                                class="list-group-item d-flex justify-content-between myBtn">{{ category.category }}
                                <span
                                    v-if="selectedCategory==category.id">>></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <transition-group name="inOut">

                            <div class="col-md-12" v-for="(product,index) in products" :key="product.id">
                                <div class="card mb-2" style="">
                                    <div class="card-body">
                                        <h5 v-bind:style="{'transition':0.4}" class="card-title">{{
                                                product.productName
                                            }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up
                                            the
                                            bulk
                                            of
                                            the card's content.</p>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm"
                                                v-on:click="getSelectedData(product)" data-toggle="modal"
                                                data-target=".exampleModalProduct">
                                            Update
                                        </button>
                                        <button v-on:click="deleteProduct(product.id,index)"
                                                class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </div>
                    <div class="modal fade exampleModalProduct" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel1"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input v-model="updatedInput.productName" class="form-control" type="text"
                                                   name="productName">
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" v-model="updatedInput.category_id"
                                                    name="category_id">
                                                <option v-for="category in categories" v-bind:value="category.id">
                                                    {{ category.category }}
                                                </option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" v-on:click="updateProduct()" data-dismiss="modal"
                                            class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import Loader from '../components/loader';

export default {
    components: {
        Loader
    },
    data() {
        return {
            message: '',
            alertType: '',
            categories: [],
            products: [],
            selectedCategory: null,
            productInput: {
                productName: '',
                category_id: '',
            },
            updatedInput: {
                productName: '',
                category_id: '',
                productId: '',
            },
            hasError: true,
            loading: false,
        }
    },

    mounted() {
        this.LoadCategories();
        this.LoadProducts();
    },
    methods: {
        LoadCategories() {
            this.loading = true;
            axios.get(`/api/categories`)
                .then((res) => {
                    this.categories = res.data.data;
                    this.loading = false;
                })
                .catch(function (err) {
                    console.log(err)
                });

        },
        LoadProducts() {
            axios.get('/api/products')
                .then((res) => {
                    this.selectedCategory = 'all';
                    this.products = res.data.data;
                })
                .catch(function (err) {
                    console.log(err);
                })
        },


        getCategoryProduct(category_id) {
            this.products = [];
            axios.get(`/api/products/${category_id}`)
                .then((response) => {
                    this.products = response.data.data;
                    this.selectedCategory = category_id;
                })
                .catch(function (err) {
                    console.log(err);
                });
        },

        createProduct() {
            var _this = this;
            var input = this.productInput;
            if (input['productName'] == '' || input['category_id'] == '') {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/api/products/create', input)
                    .then((response) => {
                        this.getCategoryProduct(input['category_id']);
                        this.productInput.productName = '';
                        this.productInput.category_id = '';
                        this.myAlert(_this, 'Created', 'success')
                        console.log(response);
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
            }
        },

        deleteProduct(product_id, index) {
            var _this = this;
            if (confirm('Are you sure?')) {
                axios.delete('/api/products/delete/' + product_id)
                    .then((res) => {
                        // alert('Product Deleted');
                        this.products.splice(index, 1);

                        this.myAlert(_this, 'Deleted Successfully', 'danger');
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
            }
        },
        getSelectedData(product) {
            this.updatedInput.category_id = product.category_id;
            this.updatedInput.productName = product.productName;
            this.updatedInput.productId = product.id;
        },
        updateProduct() {
            var _this = this;
            var inputData = this.updatedInput;
            if (inputData['category_id'] == '' || inputData['productName'] == '') {
                console.log('Empty');
            } else {
                axios.post('/api/products/update', inputData)
                    .then((response) => {
                        this.getCategoryProduct(inputData['category_id']);
                        this.myAlert(_this, 'Updated Successfully', 'warning');
                        console.log(response);
                    })
                    .catch(function (err) {
                        console.log(err);
                    })
            }
        },

        myAlert(_this, msg, alertType) {
            this.message = msg;
            this.alertType = 'alert-' + alertType;
            setTimeout(function () {
                _this.message = '';
                _this.alertType = '';
            }, 3000);


        }


    }
}
</script>

<style lang="css" scoped>
.myBtn {
}

.myBtn:hover {
    background-color: rgba(0, 0, 0, 0.25);
    cursor: pointer;
}

.deleteBtn {
    background-color: rgb(249, 63, 63);
    cursor: pointer;
    border-radius: 5px;
    color: white;
    padding: 5px;
}

.deleteBtn:hover {
    background-color: rgb(187, 33, 36);
}

.fade-enter-active, .fade-leave-active {
    transition: all .5s ease;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
    transform: translateX(40px);
    opacity: 0;
}

.inOut-enter-active {
    transition: opacity .7s;
}

.inOut-leave-active {
    transition: opacity .2s;
}

.inOut-enter, .inOut-leave-to /* .inOut-leave-active below version 2.1.8 */
{
    opacity: 0;
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
.myAlert {
    position: fixed;
    right: 8vw;
    top: 10vh;
    z-index:1;
}
</style>
