// vue.config.js
//import fs from 'fs'; // This may not work bcuz ES6 is still not fully supported on all node version, use CommonJS syntax `require` by now.
const fs = require('fs');

let config = {
    publicPath: './',
};

//If you want to `yarn serve` over HTTPS. Try uncomment below.
//For more information, read `https://webpack.js.org/configuration/dev-server/#devserverhttps` and `https://github.com/FiloSottile/mkcert`

config.devServer = {
    proxy: {
        '/api': {
            target: 'http://127.0.0.1/goodparts-of-your-wordpress-zwei/api/',
            pathRewrite: {'^/api': ''},
        },
    },
    port: 8080,
    /*
    https: {
        cert: fs.readFileSync('./test_cert/localhost.cert'),
        key: fs.readFileSync('./test_cert/localhost.key'),
        ca: fs.readFileSync('./test_cert/localhostCA.pem'),
    },
    port: 8443, // devServer can only listen either http or https at a time.
    */
};

module.exports = config;
