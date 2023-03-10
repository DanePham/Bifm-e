const sharp = require("sharp");

var path = require('path');
var express = require('express');
var app = express();

// var dir = path.join(__dirname, 'DATA');
var dir = path.join('F:/', 'DATA');

app.use(express.static(dir));

app.listen(3000, function () {
    console.log('Listening on http://localhost:3000/');
});