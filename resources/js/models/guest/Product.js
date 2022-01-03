class Product {
    static get(params, then) {
        axios.get('/api/products', {
            params: params
        })
            .then(({data}) => then(data));
    }
}

export default Product;