import Operator from '../../utils/model/operator/index';

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
            message: 'User Page',
            description: 'Manage list of users at this page.',
            categoryConfig: {
                loading: true,
                error: false
            },
            category: categoryModel,
            categories: []
        }
    },
    mounted() {
        this.bindUsers();
    },
    methods: {
        bindUsers() {
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
            categoryService.store(this, this.category)
                .then(
                    res => {
                        this.categories.push(Operator.single(categoryModel, res.body.data));
                        this.category = Operator.reset(categoryModel);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error store user, check your user input again.');
                        this.$refs.toast.show();
                    }
                )
        },
        deleteUser(category) {
            categoryService.delete(this, category.id)
                .then(
                    res => {
                        this.categories.splice(this.categories.indexOf(category), 1);
                    },
                    err => {
                        this.$refs.toast.setMessage('Error delete user');
                        this.$refs.toast.show();
                    }
                )
        },
        editUser(category) {
            this.categories[this.categories.indexOf(category)].onedit = true;
        },
        updateUser(category) {
            categoryService.update(this, category.id, category)
                .then(
                    res => {
                        this.categories[this.categories.indexOf(category)].onedit = false;
                    },
                    err => {
                        this.$refs.toast.setMessage('Error update user');
                        this.$refs.toast.show();
                    }
                );
        }
    }
}