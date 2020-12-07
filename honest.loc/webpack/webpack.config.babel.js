// const { CleanWebpackPlugin } = require('clean-webpack-plugin');
// import '@babel/polyfill';

const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const HtmlWebpackPlugin = require('html-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = (env, argv) => {
    const PROD =(argv.mode === 'production');
    let config ={
        entry: {main: './src/js/app.js'},
        output: {
            path: path.resolve(__dirname, 'dist'),
            // path: path.resolve(__dirname, '../.'),
            // publicPath: path.resolve(__dirname, 'dist'),
            filename: PROD ? 'assets/js/bundle.min.js' : 'assets/js/bundle.js'
        },
        devtool: "cheap-eval-source-map",
        target: 'node',
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: "babel-loader"
                    }
                },
                {
                    test: /\.scss$/,
                    use: ['style-loader', MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'resolve-url-loader', 'sass-loader']
                },
                // {
                //     test: /\.(png|jpg|gif)$/i,
                //     use: [
                //         {
                //             loader: 'url-loader',
                //             options: {
                //                 limit: 8192,
                //                 name: "assets/[hash].[ext]"
                //             },
                //         },
                //     ],
                // },
                {
                    test: /\.(png|svg|gif|jpg|eot|ttf|woff|woff2)$/,
                    use: [{
                        loader: 'file-loader',
                        options: {
                            name: '[path][name].[ext]',
                            context: path.resolve(__dirname, "src/"),
                            publicPath: '../../',
                            useRelativePaths: true
                        }
                    }]
                },
            ]
        },
        resolve: {
            alias: {
                snapsvg: 'snapsvg/dist/snap.svg.js',
            },
        },
        plugins: [
            new BrowserSyncPlugin({
                host: 'localhost',
                port: 3000,
                server: {baseDir: ['dist']}
            }),
            // new CleanWebpackPlugin(),
            new CopyWebpackPlugin([
                {from: 'src/assets/img/', to: 'assets/img/',},
                {from: 'src/assets/files/', to: 'assets/files/',},
            ]),
            new MiniCssExtractPlugin({
                filename: PROD ? 'assets/css/styles.min.css': 'assets/css/styles.css'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/index.html',
                filename: 'index.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/news.html',
                filename: 'news.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/partners.html',
                filename: 'partners.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/investments.html',
                filename: 'investments.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/motivation.html',
                filename: 'motivation.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/crypto.html',
                filename: 'crypto.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/credit.html',
                filename: 'credit.html'
            }),
            new HtmlWebpackPlugin({
                inject: false,
                template: './src/authpage.html',
                filename: 'authpage.html'
            }),
        ]
    };
    if (PROD) {
        config.plugins = (config.plugins || []).concat([
            new webpack.DefinePlugin({
                'process.env': {
                    NODE_ENV: '"production"'
                }
            }),
            new webpack.LoaderOptionsPlugin({
                minimize: true
            })
        ]);
    }

    return config;

};