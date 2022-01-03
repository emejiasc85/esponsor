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
                        <button @click.prevent="toEdit(product)" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                    </div>
                    <div class="px-5 py-3">
                        <span class="text-gray-500 mt-2">{{product.category.name}}</span>
                        <h3 class="text-gray-700 uppercase">{{product.title}}</h3>
                        <p class="text-gray-500 mt-2">{{product.description}}</p>
                        <span class="text-gray-500 mt-2">${{product.min_price}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- <vue-tailwind-modal
            :showing="showCreateModal"
            @close="showCreateModal = false"
            :showClose="true"
            :backgroundClose="true"
        >
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">
                                    Categoría
                                </label>
                                <div class="mt-1">
                                    <Multiselect
                                        v-model="create.category_id"
                                        :options="categories"
                                    />
                                </div>
                                <p v-if="errors.category_id" class="mt-2 text-sm text-red-500">
                                    {{errors.category_id[0]}}
                                </p>
                            </div>
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    Título
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="title" v-model="create.title"  class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md py-2 "/>
                                </div>
                                <p v-if="errors.title" class="mt-2 text-sm text-red-500">
                                    {{errors.title[0]}}
                                </p>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Descripción
                                </label>
                                <div class="mt-1">
                                    <textarea id="description" v-model="create.description" rows="3" class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" ></textarea>
                                </div>
                                <p v-if="errors.description" class="mt-2 text-sm text-red-500">
                                    {{errors.description[0]}}
                                </p>
                            </div>
                            <div>
                                <label for="min_price" class="block text-sm font-medium text-gray-700">
                                    Precio minímo
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="min_price" v-model="create.min_price"  class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md py-2 "/>
                                </div>
                                <p v-if="errors.min_price" class="mt-2 text-sm text-red-500">
                                    {{errors.min_price[0]}}
                                </p>
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">
                                    Stock
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="stock" v-model="create.stock"  class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md py-2 "/>
                                </div>
                                <p v-if="errors.stock" class="mt-2 text-sm text-red-500">
                                    {{errors.stock[0]}}
                                </p>
                            </div>
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700">
                                    Imagen
                                </label>
                                <div class="mt-1">
                                    <input type="file" id="file"  class="px-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md py-2 "/>
                                </div>
                                <p v-if="errors.file" class="mt-2 text-sm text-red-500">
                                    {{errors.file[0]}}
                                </p>
                            </div>
                        </div>
                        <div class="px-4 py-3  text-right sm:px-6">
                            <button type="button" @click="store" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </vue-tailwind-modal> -->
    </div>
</template>

<script>

import Product from '../../models/guest/Product';

export default {
    data(){
        return{
            showCreateModal: false,
            products       : [],
            errors         : {},
            create         : {},
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

        store(){
            let formData = new FormData();
            let file = document.getElementById('file').files[0];

            formData.append('file', file ? file : '');
            formData.append('title', this.create.title ? this.create.title :'');
            formData.append('description', this.create.description ? this.create.description :'');
            formData.append('min_price', this.create.min_price ? this.create.min_price :'');
            formData.append('stock', this.create.stock ? this.create.stock : '');
            formData.append('category_id', this.create.category_id ? this.create.category_id : '');

            Product.store(formData, data => {
                this.index();
                this.errors = {};
                this.create = {};
                this.showCreateModal = false;
            },error => {
                this.errors = error;
            });
        },
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
