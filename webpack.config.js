let webpack = require('webpack');

module.exports = {
    entry: [
        './src/main.js'
    ],
    output: {
        path: "/dist/js",
        publicPath: "/dist/",
        filename: "app.js"
    },
    watch: true,
    module: {
        loaders: [
            {
                test: /\.woff$/,
                loader: "url-loader?limit=10000&minetype=application/font-woff"
            },
            {
                test: /\.woff2$/,
                loader: "url-loader?limit=10000&minetype=application/font-woff"
            },
            {
                test: /\.ttf$/,
                loader: "file-loader"
            },
            {
                test: /\.eot$/,
                loader: "file-loader"
            },
            {
                test: /\.svg$/,
                loader: "file-loader"
            },
            {
                test: /\.js$/,
                // excluding some local linked packages.
                // for normal use cases only node_modules is needed.
                exclude: /node_modules|vue\/src|vue-router\//,
                loader: 'babel'
            },
            {
                test: /\.scss$/,
                loaders: ['style', 'css', 'sass']
            },
            {
                test: /\.vue$/,
                loader: 'vue'
            }
        ]
    },
    babel: {
        presets: ['es2015'],
        plugins: ['transform-runtime']
    },
    resolve: {
        modules: ['node_modules'],
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    }
};