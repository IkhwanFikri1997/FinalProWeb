import Config from '../config';

export default {
    url: Config.api + '/trans',
    fetch(y){
        return y.$http.get(this.url + '/get');
    },
    find(y, id){
        return y.$http.get(this.url + '/get' + id);
    },
    store(y, params){
        return y.$http.post(this.url +'/add', params);
    },
    delete(y,id){
        return y.$http.delete(this.url + '/del' + '/' + id);
    },
    update(y, id, params){
        return y.$http.patch(this.url + '/change' + '/' + id, params);
    }
}