var webpack = require('webpack');

var environment = process.env.NODE_ENV || 'development';

var plugins = environment === 'production' ? [
    new webpack.DefinePlugin({
        'process.env':{
            'NODE_ENV': JSON.stringify(environment)
        }
    }),
    new webpack.optimize.UglifyJsPlugin({
        compress: {
            warnings: false
        }
    })
] : [];

module.exports = {
    context: __dirname,
    entry: {
        skills: './frontend/skills'
    },

    output: {
        path: __dirname + '/web/js/dist',
        filename: '[name].js'
    },

    module: {
        loaders: [
            {
                test: /\.js$/,
                include: __dirname + '/frontend',
                loader: 'babel-loader'
            }
        ]
    },

    plugins: plugins
};
