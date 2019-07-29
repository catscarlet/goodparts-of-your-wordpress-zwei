// vue.config.js
//import fs from 'fs'; // This may not work bcuz ES6 is still not fully supported on all node version, use CommonJS syntax `require` by now.
const fs = require('fs');

let config = {
    publicPath: './',
};

//If you want to `yarn serve` over HTTPS. Try uncomment below.
//For more information, read `https://webpack.js.org/configuration/dev-server/#devserverhttps` and `https://github.com/FiloSottile/mkcert`
/*
config.devServer = {
    https: {
        cert: fs.readFileSync('./test_cert/localhost.cert'),
        key: fs.readFileSync('./test_cert/localhost.key'),
        ca: fs.readFileSync('./test_cert/localhostCA.pem'),
    },
    port: 8443,
};
*/

module.exports = config;
