import Config from '../config';

export default {
    url: Config.api + '/item',
    fetch(y){
        return y.$http.get(this.url);
    },
    find(y, id){
        return y.$http.get(this.url + '/' + id);
    },
    store(y, params){
        return y.$http.post(this.url, params);
    },
    delete(y,id){
        return y.$http.delete(this.url + '/' + id);
    },
    update(y, id, params){
        return y.$http.put(this.url + '/' + id, params);
    }
}