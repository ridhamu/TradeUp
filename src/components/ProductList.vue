<!-- contoh menampilkan list product -->

<template>
    <div>
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.category }}</td>
                    <td>
                        <img v-if="product.image_url" :src="product.image_url" alt="Product Image" width="100">
                        <span v-else>No Image</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            products: []
        }
    },

    mounted(){
        axios.get('http://127.0.0.1:8000/api/products')
        .then(response => {
            this.products = response.data.data;
        })
        .catch(error => {
            console.error('Error fetching products:', error);
        });
    }
};
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

img {
    max-width: 100px;
}
</style>
