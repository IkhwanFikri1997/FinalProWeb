import '../../assets/stylesheets/register.scss'

import Operator from '../../utils/model/operator/index';

import userModel from '../../models/user/user.model.js';
import userService from '../../services/user/user.service.js';

import LoadingPanel from '../commons/loading-panel/loading-panel.common.vue';
import ErrorPanel from '../commons/error-panel/error-panel.common.vue';
import Toast from '../commons/toast/toast.common.vue';

export default {
    components: {
        'loading-panel': LoadingPanel,
        'error-panel': ErrorPanel,
        'toast': Toast
    },
    data() {
        return {
            message: 'Register Page',
            description: 'Please fill in the form!',
            userConfig: {
                loading: true,
                error: false
            },
            user: userModel,
            users: []
        }
    },
    methods: {
        register() {
            userService.store(this, this.user)
                .then(
                    res => {
                        this.users.push(Operator.single(userModel, res.body.data));
                        this.user = Operator.reset(userModel);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error store user, check your user input again.');
                        this.$refs.toast.show();
                    }
                )
        }
    }
}