<template>
<div> <a href="{{ route('crude.create') }}">List Products</a>
<h1>Product List</h1>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products" :key="product.id">
        <td>{{ $product.id }}</td>
        <td>{{ $product.name }}</td>
        <td>{{ $product.subject }}</td>
      </tr>
    </tbody>
  </table>
  </div>

</template>
<script>

   export default {
        data() {
            return {
                products: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/crude/')
                .then(response => {
                    this.products = response.data;
                });
        },
        methods: {
            deleteProduct(id) {
                this.axios
                    .delete(`http://localhost:8000/api/products/${id}`)
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(id);
                        this.products.splice(i, 1)
                    });
            }
        }
    }
</script>
