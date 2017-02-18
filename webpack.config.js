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
    }
};
