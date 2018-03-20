export default {
    props: {
        message: {
            type: String,
            default: 'Something error'
        },
        showButton: {
            type: Boolean,
            default: true
        },
        buttonText: {
            type: String,
            default: 'Reload'
        }
    },
    methods: {
        fireEvent() {
            this.$emit('onErrorHandled')
        }
    }
}