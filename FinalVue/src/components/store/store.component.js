import Operator from '../../utils/model/operator/index';

import itemModel from '../../models/categories/categories.model.js';
import itemService from '../../services/categories/categories.services.js';

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
            itemConfig: {
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

            itemService.fetch(this)
                .then(
                    res => {
                        this.categories = Operator.map(itemModel, res.body.data);
                        this.itemConfig.loading = false;
                    },
                    err => {
                        this.itemConfig.loading = false;
                        this.itemConfig.error = true;
                    }
                );
            
            
        }        
    }
}