'use strict';
/**
 * Webpack Config
 *
 * @author      Scar Wu
 * @copyright   Copyright (c) Scar Wu (http://scar.tw)
 */

var path = require('path');

module.exports = {
    mode: 'development',
    entry: {
        theme: './src/assets/scripts/theme.js'
    },
    output: {
        filename: '[name].min.js'
    },
    resolve: {
        modules: [
            path.resolve('./src/assets/scripts'),
            'node_modules'
        ],
        extensions: [
            '.js'
        ]
    },
    module: {
        rules: [
            {
                test: /.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        cacheDirectory: true,
                        plugins: [
                            // Stage 0
                            '@babel/plugin-proposal-function-bind',

                            // Stage 1
                            '@babel/plugin-proposal-export-default-from',
                            '@babel/plugin-proposal-logical-assignment-operators',
                            ['@babel/plugin-proposal-optional-chaining', { 'loose': false }],
                            ['@babel/plugin-proposal-pipeline-operator', { 'proposal': 'minimal' }],
                            ['@babel/plugin-proposal-nullish-coalescing-operator', { 'loose': false }],
                            '@babel/plugin-proposal-do-expressions',

                            // Stage 2
                            ['@babel/plugin-proposal-decorators', { 'legacy': true }],
                            '@babel/plugin-proposal-function-sent',
                            '@babel/plugin-proposal-export-namespace-from',
                            '@babel/plugin-proposal-numeric-separator',
                            '@babel/plugin-proposal-throw-expressions',

                            // Stage 3
                            '@babel/plugin-syntax-dynamic-import',
                            '@babel/plugin-syntax-import-meta',
                            ['@babel/plugin-proposal-class-properties', { 'loose': false }],
                            '@babel/plugin-proposal-json-strings'
                        ],
                        presets: [
                            ['@babel/preset-env', { useBuiltIns: 'usage', corejs: 3 }]
                        ]
                    }
                }
            }
        ]
    }
}