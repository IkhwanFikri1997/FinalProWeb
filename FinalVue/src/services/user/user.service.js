import Config from '../config';

export default {
    url: Config.api + '/auth',
    show(y){
        return y.$http.get(this.url +'/show');
    },
    logout(y){
        return y.$http.get(this.url + '/logout');
    },
    login(y, params){
        return y.$http.post(this.url + '/login', params);
    },
    refresh(y,id){
        return y.$http.post(this.url + '/refresh');
    },
    register(y, params){
        return y.$http.post(this.url + '/register', params);
    },
    me(y, params){
        return y.$http.post(this.url + '/me');
    }
}