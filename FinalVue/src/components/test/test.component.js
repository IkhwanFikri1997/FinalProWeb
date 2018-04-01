import Operator from '../../utils/model/operator/index';

import itemModel from '../../models/item/item.model.js';
import itemService from '../../services/items/items.services.js';
import categoryModel from '../../models/categories/categories.model.js';
import categoryService from '../../services/categories/categories.services.js';

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
            message: 'Item Page',
            description: 'Manage list of items at this page.',
            itemConfig: {
                loading: true,
                error: false
            },
            item: itemModel,
            items: [],
            categoryConfig: {
                loading: true,
                error: false
            },
            category: categoryModel,
            categories: []
        }
    },
    mounted() {
        this.bindItem();
        this.bindUsers();
    },
    methods: {
        bindUsers() {
            this.itemConfig.loading = true;
            this.itemConfig.error = false;

            itemService.fetch(this)
                .then(
                    res => {
                        this.items = Operator.map(itemModel, res.body.data);
                        this.itemConfig.loading = false;
                    },
                    err => {
                        this.itemConfig.loading = false;
                        this.itemConfig.error = true;
                    }
                );
        },
        bindItem(){
            this.categoryConfig.loading = true;
            this.categoryConfig.error = false;

            categoryService.fetch(this)
                .then(
                    res => {
                        this.categories = Operator.map(categoryModel, res.body.data);
                        this.categoryConfig.loading = false;
                    },
                    err => {
                        this.categoryConfig.loading = false;
                        this.categoryConfig.error = true;
                    }
                );
        },
        storeUser() {
            itemService.store(this, this.item)
                .then(
                    res => {
                        this.items.push(Operator.single(itemModel, res.body.data));
                        this.item = Operator.reset(itemModel);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error store user, check your user input again.');
                        this.$refs.toast.show();
                    }
                )
        },
        deleteUser(item) {
            itemService.delete(this, item.id)
                .then(
                    res => {
                        this.items.splice(this.items.indexOf(item), 1);
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
            itemService.update(this, item.id, item)
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