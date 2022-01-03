class Product {
    static get(params, then) {
        axios.get('/api/admin/products', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/products').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({label: element.id, value: element.name});
            });

            then(elements);
        });
    }

    static store(data, then, error) {
        axios.post('/api/admin/products', data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
    axios.post('/api/admin/products/'+element, data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }

    static delete(element, then) {
        axios.delete('/api/admin/products/' + element)
            .then(({data}) => then(data.data));
    }
}

export default Product;