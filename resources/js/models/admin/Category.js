class Category {
    static get(params, then) {
        axios.get('/api/admin/categories', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/categories').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({label: element.name, value: element.id});
            });

            then(elements);
        });
    }

    static store(data, then, error) {
        axios.post('/api/admin/categories', data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
    axios.put('/api/admin/categories/'+element, data)
            .then(({data}) => then(data.data))
            .catch(({response}) => error(response.data.errors));
    }

    static delete(element, then) {
        axios.delete('/api/admin/categories/' + element)
            .then(({data}) => then(data.data));
    }
}

export default Category;