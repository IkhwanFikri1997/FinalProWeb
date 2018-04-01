import Config from '../config';

export default {
    url: Config.api + '/item',
    fetch(y){
        return y.$http.get(this.url + '/get');
    },
    find(y, id){
        return y.$http.get(this.url + '/get' + '/' + id);
    },
    store(y, params){
        return y.$http.post(this.url + '/add' , params);
    },
    delete(y,id){
        return y.$http.delete(this.url + '/del' + '/' + id);
    },
    update(y, id, params){
        return y.$http.post(this.url + '/change' + '/' + id, params);
    },
    search(y,q,params){
        return y.$http.get(this.url + '/search' + '/' +q , params)
    }
}