<?php
const DB_HOST = "localhost";
const DB_LOGIN = "root";
const DB_PASSWORD = "djuice";
const DB_NAME = "eshop";
$link = mysqli_connect(DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
const ORDERS_LOG = "order.log";
$basket = [];
$count = 0;
basketInit();