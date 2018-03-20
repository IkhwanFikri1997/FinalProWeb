export default {
    data() {
        return {
            message: "Action Loading...",
            duration: 2000,
            config: {
                show: false
            }
        }
    },
    methods: {
        getMessage() {
            return this.message;
        },
        setMessage(message) {
            message = message || this.message;
            this.message = message;
        },
        getDuration() {
            return this.duration;
        },
        setDuration(duration) {
            duration = duration || 3000;
            this.duration = duration;
        },
        show() {
            this.config.show = true;
            this.bindToggle();
        },
        hide() {
            this.config.show = false;
        },
        bindToggle() {
            if(this.config.show) {
                setTimeout(() => {
                    this.hide();
                }
            ), this.duration)
            }
        }
    }
}