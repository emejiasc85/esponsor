class Cart {
    static get(params, then) {
        axios.get('/api/admin/products', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/carts', data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default Cart;