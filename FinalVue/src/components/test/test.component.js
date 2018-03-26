import Operator from '../../utils/model/operator/index';

import itemModel from '../../models/item/item.model.js';
import itemService from '../../services/items/items.services.js';

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
            this.userConfig.loading = true;
            this.userConfig.error = false;

            itemService.fetch(this)
                .then(
                    res => {
                        this.items = Operator.map(UserModel, res.body.data);
                        this.userConfig.loading = false;
                    },
                    err => {
                        this.userConfig.loading = false;
                        this.userConfig.error = true;
                    }
                );
        },
        storeUser() {
            ItemService.store(this, this.item)
                .then(
                    res => {
                        this.items.push(Operator.single(ItemModel, res.body.data));
                        this.item = Operator.reset(ItemModel);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error store user, check your user input again.');
                        this.$refs.toast.show();
                    }
                )
        },
        deleteUser(item) {
            ItemService.delete(this, item.id)
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
            ItemService.update(this, item.id, item)
                .then(
                    res => {
                        this.items[this.items.indexOf(item)].onedit = false;
                    },
                    err => {
                        this.$refs.toast.setMessage('Error update user');
                        this.$refs.toast.show();
                    }
                );
        }
    }
}