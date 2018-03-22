import Operator from '../../utils/model/operator/index';

import ItemModel from '../../models/user/item.model';
import ItemService from '../../services/user/item.service';

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
            message: 'User Page',
            description: 'Manage list of users at this page.',
            userConfig: {
                loading: true,
                error: false
            },
            item: itemModel,
            items: []
        }
    },
    mounted() {
        this.bindUsers();
    },
    methods: {
        bindUsers() {
            this.itemConfig.loading = true;
            this.itemConfig.error = false;

            UserService.fetch(this)
                .then(
                    res => {
                        this.users = Operator.map(UserModel, res.body.data);
                        this.userConfig.loading = false;
                    },
                    err => {
                        this.userConfig.loading = false;
                        this.userConfig.error = true;
                    }
                );
        },
        storeUser() {
            UserService.store(this, this.user)
                .then(
                    res => {
                        this.users.push(Operator.single(UserModel, res.body.data));
                        this.user = Operator.reset(UserModel);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error store user, check your user input again.');
                        this.$refs.toast.show();
                    }
                )
        },
        deleteUser(item) {
            UserService.delete(this, user.id)
                .then(
                    res => {
                        this.users.splice(this.users.indexOf(item), 1);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error delete user');
                        this.$refs.toast.show();
                    }
                )
        },
        editUser(item) {
            this.items[this.items.indexOf(item)].onedit = true;
        },
        updateUser(item) {
            UserService.update(this, item.id, user)
                .then(
                    res => {
                        this.items[this.users.indexOf(item)].onedit = false;
                    },
                    err => {
                        this.$refs.toast.setMessage('Error update user');
                        this.$refs.toast.show();
                    }
                );
        }
    }
}