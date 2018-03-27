export default {
    reset (model) {
        let response = {};

        for(let key in model) {
            if (typeof model[key] == 'String') {
                model[key] = '';
            } else {
                model[key] = null;
            }
        }
        return model;
    },

    map(model, data){
        if(data.length <= 0) return;
        let responses= [];
        for(let i=0; i < data.length; i++){
            let raw = data[i];
            let response = {};

            for (let key in model){
                response[key] = raw[key];
            }
            response['onedit'] = false;

            responses.push(response);
        }

        return responses;
    },

    single(model, data) {
        let response = {};

        for(let key in model){
            response[key]=data[key];
        }
        response['onedit'] = false;

        return response;
    }
}