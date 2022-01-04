<template>
    <div>
        <div class="relative mt-6 max-w-lg mx-auto mb-10">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <input @keyup.enter="index" v-model="filter.search" class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Buscar: nombre, descripción, categoría">
        </div>
        <div class="container mx-auto px-6">
            <div class="flex justify-between">
                <h3 class="text-gray-700 text-2xl font-medium">Productos</h3>
            </div>
            <span class="mt-3 text-sm text-gray-500">{{products.length }} Productos</span>

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                <div v-for="product in products" :key="product.id" class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full bg-cover" :style="'background-image: url('+product.file.show_url+')'">
                        <button @click.prevent="toCart(product)" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                    <div class="px-5 py-3">
                        <span class="text-gray-500 mt-2">{{product.category.name}}</span>
                        <div class="flex justify-between">
                            <h3 class="text-gray-700 uppercase ">{{product.title}} </h3>
                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-blue-100 bg-blue-600 rounded-full">{{product.stock}}</span>
                        </div>
                        <p class="text-gray-500 mt-2">{{product.description}}</p>
                        <span class="text-gray-500 mt-2">${{product.min_price}}</span>
                    </div>
                </div>
            </div>
        </div>
        <vue-tailwind-modal
            :showing="showLoginModal"
            @close="showLoginModal = false"
            :showClose="true"
            :backgroundClose="true"
        >
            <div class="max-w-lg w-full rounded-lg p-4">
                <h3 class="font-semibold text-lg tracking-wide text-red-500">Ups... No has iniciado sesión</h3>
                <p class="text-gray-500 my-1">
                    Debes iniciar sesión para poder realizar una compra
                </p>
                <div class="mt-2">
                    <a href="/login" class="text-blue-700  inline-flex items-center font-semibold tracking-wide">
                        <span class="hover:underline">
                            Iniciar sesión
                        </span>
                        <span class="text-xl ml-2">&#8594;</span>
                    </a>
                </div>
            </div>
        </vue-tailwind-modal>
        
        <vue-tailwind-modal
            :showing="showChangePrice"
            @close="showChangePrice = false"
            :showClose="true"
            :backgroundClose="true"
        >
            <div class="max-w-lg w-full rounded-lg p-4">
                <h3 class="font-semibold text-lg tracking-wide text-red-500">Cambiar precio</h3>
                <p class="text-gray-500 my-1">
                    El precio debe ser mayor al precio minimo establecido
                </p>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Precio minimo
                    </label>
                    <div class="mt-1">
                        <input type="text" id="title" v-model="cart.price"  class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md py-2 "/>
                    </div>
                </div>
                <div class="px-4 py-3  text-right sm:px-6">
                    <button type="button" @click="changePrice" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Aplicar
                    </button>
                </div>
            </div>
        </vue-tailwind-modal>

        <div :class="showCart ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-medium text-gray-700">Tu pedido</h3>
                    <button @click="showCart = !showCart" class="text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <hr class="my-3">
                <div v-if="cart.id" class="flex justify-between mt-6">
                    <div class="flex">
                        <img v-if="cart.file" class="h-20 w-20 object-cover rounded" :src="cart.file.show_url" alt="">
                        <div class="mx-3">
                            <h3 class="text-sm text-gray-600">{{cart.title}}</h3>
                            <div class="flex items-center mt-2">
                                <button type="button" :disabled="cart.quantity == 1" @click.prevent="down" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                                <span class="text-gray-700 mx-2">{{cart.quantity}}</span>
                                <button type="button" :disabled="cart.stock == cart.quantity" @click.prevent="up" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-gray-600">
                        ${{cart.price}} 
                        <p>
                            <a href="#" @click.prevent="showChangePrice=true" class="text-indigo-500 text-sm justify-end">Editar precio</a>
                        </p>
                    </span>
                    
                </div>
                <div v-if="cart.id" class="flex justify-between mt-6">
                    <div class="flex">
                        <div class="mx-3">
                            <h3 class="text-md text-gray-800">Total</h3>
                        </div>
                    </div>
                    <span class="text-gray-600">${{cart.total}}</span>
                </div>
                
                <button type="button" @click.prevent="store" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Comprar</span>
                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
        </div>
    </div>
</template>

<script>

import Product from '../../models/guest/Product';
import Cart from '../../models/admin/Cart';

export default {

    props:['is_logged'],

    data(){
        return{
            showLoginModal : false,
            showChangePrice : false,
            showCart       : false,
            products       : [],
            errors         : {},
            cart           : {
                quantity  : 1,
                price     : 0,
                real_price: 0,
                total: 0,
            },
            filter         : {}
        }
    },
    created(){
        this.index();
    },

    methods:{

        index(){
            let parameters = {
                search : this.filter.search
            };

            Product.get(parameters, data => {
                this.products   = data.data;
            });
        },

        toCart(product){
            if(this.is_logged){
                product.product_id = product.id;
                product.quantity = 1;
                product.real_price = product.min_price;
                product.price = product.min_price;
                product.total = product.min_price;
                this.cart = _.cloneDeep(product);
                this.showCart = true
            }else{
                this.showLoginModal = true;
            }
        },

        down(){
            this.cart.quantity = this.cart.quantity - 1;
            this.cart.total = this.cart.price * this.cart.quantity;
        },
        
        up(){
            let cart = this.cart;
            cart.quantity = cart.quantity + 1;
            cart.total = cart.price * cart.quantity;

            this.cart = cart;
        },

        changePrice(){
            this.cart.total = this.cart.price * this.cart.quantity;
            this.showChangePrice = false;
        },

        store(){
            let cart = {
                products :[]
            };

            cart.products.push(this.cart);
            
            Cart.store(cart, data => {
                this.index();
                this.errors   = {};
                this.cart     = {};
                this.showCart = false;
            },error => {
                this.errors = error;
            });
        },
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
